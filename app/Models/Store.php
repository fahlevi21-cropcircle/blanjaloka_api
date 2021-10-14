<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    //
    use SoftDeletes, HasFactory;

    public $timestamps = true;

    protected $fillable = ['name', 'description', 'category', 'owner_id', 'updated_at', 'created_at', 'deleted_at'];
}
