<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'device_token', 'name', 'mobile_no', 'email',
        'image', 'aadhar_card_no', 'pan_card_no'
    ];
}
