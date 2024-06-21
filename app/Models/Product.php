<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PriceHistory;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id_producto';
    public $timestamps = false;
    protected $fillable = ['name', 'technical_code', 'unit', 'unit_price', 'description', 'technical_sheet'];

    public function priceHistory()
    {
        return $this->hasMany(PriceHistory::class, 'product_id');
    }
}


