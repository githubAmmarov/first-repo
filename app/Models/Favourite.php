<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Favourite extends Model
{
    use HasFactory;
    protected $table='favourites';
    protected $fillable=[
        'user_id',
        'product_id'
    ];
    /**
    MY PK IS FK WHERE?
     **/


    /**
    MY FK BELONGS TO?
     **/
    public function user():BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
    public function product():BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
