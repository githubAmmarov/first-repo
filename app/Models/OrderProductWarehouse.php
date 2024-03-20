<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class OrderProductWarehouse extends Model
{
    use HasFactory;
    protected $fillable=
    [
        'order_id',
        'product_warehouse_id',
        'quantity',
        'total_price',
    ];
    public function Order()
    {
        return $this->belongsTo(Order::class);
    }
    public function ProductWarehouse()
    {
        return $this->belongsTo(ProductWarehouse::class);
    }
}
