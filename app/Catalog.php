<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $table = "catalog_categories";
    protected $fillable = ['parent_id', 'name', 'description', 'active', 'url_part'];
}
