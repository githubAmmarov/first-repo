<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pharmacy extends Model
{
    use HasFactory;
    protected $table= 'pharmacies';
    protected $fillable=[
        'user_id',
        'pharmacy_name'
    ];
    /**
    MY PK IS FK WHERE?
     **/

    /**
    MY FK BELONGS TO?
     **/
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
