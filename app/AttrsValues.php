<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttrsValues extends Model
{
    protected $table = "catalog_attribute_value";
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
