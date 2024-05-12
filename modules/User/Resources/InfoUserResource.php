<?php

namespace Modules\User\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InfoUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "user" => [
                "id" => $this->id,
                "name" => $this->name,
                "email" => $this->email,
                "image" => $this->image?->url
            ],
            "menus" => $this->menus,
            "roles" => UserRoleResource::collection($this->role_names)
        ];
    }

    // "id" => $this->id,
    // "name" => $this->name,
    // "email" => $this->email,
    // "image" => $this->image?->url,
    // "menus" => $this->menus,
    // "role_names" => $this->roleNames
}
