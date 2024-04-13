<?php

namespace Modules\User\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RolesResource extends JsonResource
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
            "id" => $this->id,
            "name" => $this->name,
            "members" => $this->users_count
        ];
    }
}
