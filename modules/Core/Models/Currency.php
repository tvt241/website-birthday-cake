<?php

namespace Modules\Core\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "symbol",
        "code",
        "exchange_rate",
        "lang_id",
        "is_default"
    ];
}
