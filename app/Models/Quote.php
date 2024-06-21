<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\QuoteProduct;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'quote_products')
            ->withPivot('price')
            ->withTimestamps();
    }
}
