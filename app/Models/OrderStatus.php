<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderStatus extends Model
{
    use HasFactory;
    protected $fillable=
        [
            'warehouse_id',
            'user_id',
            'order_id',
            'status',
            'payment_status',
        ];
    /**
    MY PK IS FK WHERE?
     **/
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    /**
    MY FK BELONGS TO?
     **/
}
