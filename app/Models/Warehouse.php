<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Warehouse extends Model
{
    use HasFactory;
    protected $table="warehouses";
    protected $fillable=
        [
            'user_id',
            'warehouse_name'
        ];
    /**
    MY PK IS FK WHERE?
     **/
    public function order():HasMany
    {
        return $this->hasMany(Order::class);
    }
    public function productWarehouse():HasMany
    {
        return $this->hasMany(ProductWarehouse::class);
    }
    /**
    MY FK BELONGS TO?
     **/
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}