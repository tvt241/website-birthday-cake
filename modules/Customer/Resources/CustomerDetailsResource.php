<?php

namespace Modules\Customer\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Customer\Enums\CustomerSocialEnum;

class CustomerDetailsResource extends JsonResource
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
            "username" => $this->username,
            "name" => $this->name,
            "email" => $this->email,
            "phone" => $this->phone,
            "birthday" => $this->birthday?->format("Y-m-d"),
            "gender" => $this->gender,
            "social" => CustomerSocialEnum::getKey($this->social),
            "is_active" => $this->is_active,
            "image" => $this->image?->url
        ];
    }
}
