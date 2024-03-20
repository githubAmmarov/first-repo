<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductWarehouse extends Model
{
    use HasFactory;
    protected $table="product_warehouses";
    protected $fillable=
        [
            'product_id',
            'warehouse_id',
            'quantity'
        ];
    /**
    MY PK IS FK WHERE?
     **/
    public function ordersProductsWarehouse():HasMany
    {
        return $this->hasMany(OrderProductWarehouse::class);
    }
    /**
    MY FK BELONGS TO?
     **/
    public function warehouse():BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }
    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
