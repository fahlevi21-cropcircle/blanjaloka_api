<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //
    use HasFactory, SoftDeletes;

    public $timestamps = true;


    protected $fillable = [
        'name', 'price', 'description', 'category', 'measure', 'stock', 'store_id', 'picture', 'deleted_at', 'updated_at', 'created_at'
    ];

    protected $hidden = [
        'store_id', 'deleted_at'
    ];

    public function withStore()
    {
        # code...
        return $this->hasOne(Store::class);
    }
}
