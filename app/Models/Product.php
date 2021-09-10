<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'tb_product';
    protected $fillable = ['name','category','price','discount','weight','satuan','stock','description','images','tag'];
}
