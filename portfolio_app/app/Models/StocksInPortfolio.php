<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StocksInPortfolio extends Model
{
    use HasFactory;
    protected $fillable = [
        'portfolio_id',
        'stock_id'
    ];
}
