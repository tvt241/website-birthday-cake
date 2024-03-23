<?php

namespace Modules\Core\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GatewayOption extends Model
{
    use HasFactory;

    protected $fillable = [
        "key",
        "value",
        "model_id",
        "model_name",
    ];

    public function model()
    {
        return $this->morphTo();
    }
}
