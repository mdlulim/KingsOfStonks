<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "symbol",
        "name",
        "price",
        "changesPercentage",
        "change",
        "dayLow",
        "dayHigh",
        "yearHigh",
        "yearLow",
        "marketCap",
        "priceAvg50",
        "priceAvg200",
        "exchange",
        "volume",
        "avgVolume",
        "open",
        "previousClose",
        "eps",
        "pe",
        "earningsAnnouncement",
        "sharesOutstanding",
        "timestamp"
    ];
}
