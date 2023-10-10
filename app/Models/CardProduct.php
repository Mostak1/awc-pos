<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CardProduct extends Model
{ use HasFactory, SoftDeletes;
    protected $fillable = [
        'customer_prepaid_card_id', 'total_meal', 'consumrd_meal', 'menu_id'
    ];
    public function prepaidCard(){
        return $this->belongsTo(CustomerPrepaidCard::class);
    }
    public function menu(){
        return $this->belongsTo(Menu::class);
    }
}
