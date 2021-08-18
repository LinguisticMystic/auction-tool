<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    protected $fillable = [
        'bidder_name',
        'bidder_phone',
        'bid_amount',
        'auction_item_id'
    ];
}
