<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    protected $fillable = [
        'page_key',
        'product_id',
        'data_seo',
    ];
}
