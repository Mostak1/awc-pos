<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name', 'images'
    ];
    public function subcategories(){
        return $this->hasMany(SubCategory::class);
    }
    public function menus(){
        return $this->hasMany(Menu::class);
    }
}
