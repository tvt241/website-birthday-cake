<?php

namespace Modules\User\Http\Controllers\Auth;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Helpers\HttpAuthHelper;
use Modules\Core\Traits\ResponseTrait;
use Modules\User\Models\User;
use Modules\User\Resources\InfoUserResource;
use Modules\User\Resources\MenuResource;
use PDO;

class LoginApiController extends Controller
{
    use ResponseTrait;
    public $http;

    public function __construct(HttpAuthHelper $httpAuthHelper)
    {
        $this->http = $httpAuthHelper;
    }
    public function login(Request $request)
    {
        $url = "oauth/token";
        $data = [
            'grant_type' => 'password',
            'username' => $request->username,
            'password' => $request->password,
        ];
        $response = $this->http->post($url, $data);
        $status = $response->status();
        if($status != 200){
            return $this->ErrorResponse("Thông tin đăng nhập không đúng");
        }
        $result = $response->object();
        return $this->SuccessResponse($result);
    }

    public function refresh(Request $request)
    {
        $url = "oauth/token";
        $data = [
            'grant_type' => 'refresh_token',
            'refresh_token' => $request->refresh_token,
        ];

        $response = $this->http->post($url, $data);
        $status = $response->status();
        $result = $response->object();
        return $this->SuccessResponse($result, $result->message, $status);
    }

    public function info(Request $request){
        $user = auth()->user();
        $permissions = $user->roles()
            ->join("role_has_permissions", "roles.id", "=", "role_has_permissions.role_id")
            ->join("permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("label", "<>", null)
            ->get([
                "permissions.id", 
                "permissions.title", 
                "permissions.name",
                "permissions.module",
                "permissions.label",
                "permissions.icon",
                "permissions.is_sub",
                "permissions.menu_parent",
            ])->toArray();
        $menusParent = [];
        foreach($permissions as $key => $menu){
            if(!$menu["menu_parent"]){
                $menusParent[] = array_slice($menu, 0, 9) ;
            }
        }
        foreach($menusParent as $key => $menuParent){
            foreach($permissions as $menu){
                if($menu["menu_parent"] == $menuParent["id"]){
                    $menusParent[$key]["children"][] = array_slice($menu, 0, 9) ;
                }
            }
        }
        $menus = [];
        foreach($menusParent as $menu){
            $key = $menu["module"];
            $menus[$key][] = $menu;
        }
        $user->menus = $menus;

        $permissions = $user->roles()
            ->join("role_has_permissions", "roles.id", "=", "role_has_permissions.role_id")
            ->join("permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->get([
                "permissions.name",
                "permissions.title",
            ]);
        $user->role_names = $permissions;

        return $this->SuccessResponse(new InfoUserResource($user));
    }

    public function logout(Request $request){
        $token = auth()->user()->token();
        $token->revoke();
        return $this->SuccessResponse([]);
    }
    // public function abc(){
    //     $permissions = $user->roles()
    //         ->join("role_has_permissions", "roles.id", "=", "role_has_permissions.role_id")
    //         ->join("permissions", "role_has_permissions.permission_id", "=", "permissions.id")
    //         ->get([
    //             "permissions.id", 
    //             "permissions.title", 
    //             "permissions.name",
    //             "permissions.module",
    //             "permissions.label",
    //             "permissions.icon",
    //             "permissions.is_sub",
    //             "permissions.menu_parent",
    //         ])->toArray();

    //     $menusParent = [];
    //     foreach($permissions as $key => $menu){
    //         if(!$menu["menu_parent"]){
    //             $menusParent[] = array_slice($menu, 0, 9) ;
    //         }
    //     }
    //     foreach($menusParent as $key => $menuParent){
    //         foreach($permissions as $menu){
    //             if($menu["menu_parent"] == $menuParent["id"]){
    //                 $menusParent[$key]["children"][] = array_slice($menu, 0, 9) ;
    //             }
    //         }
    //     }
    //     $menus = [];
    //     foreach($menusParent as $menu){
    //         $key = $menu["module"];
    //         $menus[$key][] = $menu;
    //     }

    //     $user->menus = $menus;
    // }
}
