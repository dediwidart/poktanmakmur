<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;
    protected $table = 'tb_config';
    protected $guarded = [];

    public static function getApplicationName(){
        return Config::orderBy('id','DESC')->first()->app_name;
    }
}
