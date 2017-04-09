<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attrs extends Model
{
    protected $table = "catalog_attribute";
    protected $fillable = ['name', 'category_id', 'type'];
}
