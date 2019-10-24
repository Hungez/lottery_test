<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseNumber extends Model
{
    protected $table = 'purchase_numbers';

    protected $fillable = [
        'user_id', 'purchase_number'
    ];
}
