<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable =[
        "productname",
        "description",
        "stock",
        "selling",
        "original",
        "type",
        "status",
        "image",
        "title",
        "keyword",
        "mdescription",
    ];


    
}
