<?php

namespace Modules\User\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Core\Traits\ResponseTrait;
use Modules\User\Models\Permission;
use Modules\User\Models\User;
use Modules\User\Resources\PermissionResource;
use Modules\User\Resources\RolesResource;
use Spatie\Permission\Models\Role;

class RoleApiController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $roles = DB::table("roles")
            ->leftJoin("model_has_roles", function($join){
                $join->on("model_has_roles.role_id", "=", "roles.id")
                    ->where("model_type", User::class);
            })
            ->select(["roles.id", "roles.name"])
            ->addSelect(DB::raw("count(model_has_roles.role_id) as user_count"))
            ->groupBy("roles.id", "roles.name")
            ->orderBy("roles.id")
            ->get();
        return $this->SuccessResponse(RolesResource::collection($roles));
    }

    public function store(Request $request)
    {
        $role = Role::create();
        return $this->SuccessResponse($role);
    }

    public function show($id)
    {
        $role = Role::find($id);
        if (!$role) {
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 422);
        }
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        if (!$role) {
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 422);
        }
        return $this->SuccessResponse();
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        if (!$role) {
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 422);
        }
        return $this->SuccessResponse();
    }

    public function permissionByRole($id){
        $role = Role::find($id);
        if (!$role) {
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 422);
        }
        $permissions = Permission::tree()->get(["id", "title", "name", "depth", "menu_parent"]);
        $rolePermission = $role->permissions->pluck("id")->toArray();
        foreach($permissions as $permission){
            if(in_array($permission->id, $rolePermission)){
                $permission->asset = true;
                continue;
            }
            $permission->asset = false;
        }
        return $this->SuccessResponse($permissions->toTree());
    }

    public function updatePermissionByRole(Request $request, $id){
        $role = Role::find($id);
        if (!$role) {
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 422);
        }
        try {
            $role->syncPermissions($request->permissions);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(message: $th->getMessage());
        }
        return $this->SuccessResponse();
    }
}
