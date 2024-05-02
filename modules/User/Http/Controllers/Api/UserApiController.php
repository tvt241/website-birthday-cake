<?php

namespace Modules\User\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Core\Services\Image\ImageService;
use Modules\Core\Traits\ResponseTrait;
use Modules\User\Http\Requests\User\StoreUserRequest;
use Modules\User\Http\Requests\User\UpdateUserRequest;
use Modules\User\Models\Permission;
use Modules\User\Models\User;
use Modules\User\Resources\UserResource;
use Spatie\Permission\Models\Role;

class UserApiController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $users = User::query()->with(["roles", "image"])->select(["id", "name", "email", "phone", "is_active"])->paginate();
        $newItems = $users->getCollection()->map(function ($user) {
            return new UserResource($user);
        });
        $users->setCollection($newItems);
        return $this->SuccessResponse($users);
    }

    public function store(StoreUserRequest $request, ImageService $imageService)
    {
        $user = User::create($request->validated());
        $role = Role::find($request->role_id);
        $user->syncRoles($role);
        if($request->has("image")){
            $imageService->store($request->image, $user, "users");
        }
        return $this->SuccessResponse($user);
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 422);
        }
        return $this->SuccessResponse(new UserResource($user));
    }

    public function update(UpdateUserRequest $request, $id, ImageService $imageService)
    {
        $user = User::find($id);
        if (!$user) {
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 422);
        }
        DB::beginTransaction();
        try {
            $user->update($request->validated());
            $role = Role::find($request->role_id);
            $user->syncRoles($role);
            if($request->image){
                $imageService->update($request->image, $user, "users");
            }
            DB::commit();
            return $this->SuccessResponse();
        } catch (\Exception $th) {
            DB::rollBack();
            return $this->ErrorResponse($th->getMessage());
        }       
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
