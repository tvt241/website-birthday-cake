<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        "url",
        "model_id",
        "model_name",
    ];
    public $timestamps = false;

    public function model(): MorphTo
    {
        return $this->morphTo();
    }
    
    // protected static function newFactory()
    // {
    //     return \Modules\Core\Database\factories\ImageFactory::new();
    // }
}
