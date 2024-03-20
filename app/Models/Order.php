<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;
    protected $table='orders';
    protected $fillable=
        [
            'warehouse_id',
            'order_status',
            'user_id',
            'order_price'
        ];
    /**
    MY PK IS FK WHERE?
     **/
    public function orderProductWarehouse():HasMany
    {
        return $this->hasMany(OrderProductWarehouse::class);
    }
    public function orderStatus()
    {
        return $this->hasOne(OrderStatus::class);
    }
    /**
    MY FK BELONGS TO?
     **/
    public function warehouse():BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
