<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menulog extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'menu_id', 'user_id', 'old', 'new', 'methode'
     ];
     public function user(){
        return $this->belongsTo(User::class);
     }
     public function menu(){
        return $this->belongsTo(Menu::class);
     }
}
