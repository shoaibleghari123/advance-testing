<?php

namespace App\Models;

use App\Exceptions\CurrencyRateNotFoundException;
use App\Services\CurrencyService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';
    protected $fillable = ['name', 'price', 'is_published', 'published_at'];

    public function getPriceEurAttribute()
    {
        try {
            return (new CurrencyService())->convert($this->price, 'USD', 'EUR');
        }catch (CurrencyRateNotFoundException $e) {
            //alert someone- do logic here
            return 0;
        }

    }
}
