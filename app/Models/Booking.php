<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Booking extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'auction_item_id',
        'amount',
        'buyer_name',
        'buyer_phone',
    ];

    public $sortable = [
        'auction_item_id',
        'amount',
        'buyer_name',
        'buyer_phone'
    ];
}
