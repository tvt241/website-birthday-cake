<?php

namespace Modules\User\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
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
            "title" => $this->title,
            "name" => $this->name,
            "module" => $this->module,
            "label" => $this->label,
            "icon" => $this->icon,
            "type" => $this->type,
            "url" => $this->url,
            "menu_parent" => $this->menu_parent
        ];
    }
}
