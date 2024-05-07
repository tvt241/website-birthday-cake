<?php

namespace Modules\Customer\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Customer\Enums\CustomerSocialEnum;

class CustomerResource extends JsonResource
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
            "full_name" => $this->name,
            "email" => $this->email,
            "phone" => $this->phone,
            "birthday" => $this->birthday?->format("d-m-Y"),
            "social" => CustomerSocialEnum::getKey($this->social),
            "is_active" => $this->is_active,
            "image" => $this->image?->url
        ];
    }
}
