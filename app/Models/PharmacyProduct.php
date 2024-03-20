<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PharmacyProduct extends Model
{
    use HasFactory;
    protected $fillable=
        [
            'pharmacy_id',
            'product_id',
            'quantity'
    ];
    /**
    MY PK IS FK WHERE?
 **/

    /**
    MY FK BELONGS TO?
     **/
    public function pharmacy():BelongsTo
    {
        return $this->belongsTo(Pharmacy::class);
    }
    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
