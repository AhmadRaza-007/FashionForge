<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'transaction_type',
        'first_name',
        'last_name',
        'email',
        'address',
        'address_2',
        'country',
        'city',
        'zip_code',
        'phone',
        'email_offers',
        'save_information',
    ];
}
