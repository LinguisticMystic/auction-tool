<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuctionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'starting_bid',
        'path_to_QR_image',
        'path_to_item_image',
        'original_file_name',
        'size'
    ];

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }
}
