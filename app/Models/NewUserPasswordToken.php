<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewUserPasswordToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'token'
    ];

    public function deleteByToken($token){
        return $this->where('token', $token)->delete();
    }
}
