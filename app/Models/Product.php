<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Product extends Model
{
    use HasFactory;
    protected $table= 'products';
    protected $fillable=[
        'scientific_name',
        'commercial_name',
        'category',
        'manufacturer',
        'price',
        'image_url',
        'expire_date'
    ];
    /**
    MY PK IS FK WHERE?
     **/
    public function favourite():HasOne
    {
        return $this->hasOne(Favourite::class);
    }
    public function pharmaciesProducts(): HasMany
    {
        return $this->hasMany(Pharmacy::class);

    }

    public function productWarehouse():HasMany
    {
        return $this->hasMany(ProductWarehouse::class);
    }
    /**
    MY FK BELONGS TO?
     **/
}
