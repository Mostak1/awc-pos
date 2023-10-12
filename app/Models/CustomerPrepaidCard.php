<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerPrepaidCard extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name', 'email', 'customer_card_number', 'card_valid_date', 'card_activation_date', 'card_status','total_meal', 'consumrd_meal', 'menu_id'
    ];
    public function menu(){
        return $this->belongsTo(Menu::class);
    }
}
