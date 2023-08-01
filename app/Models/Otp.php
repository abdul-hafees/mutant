<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
class Otp extends Model
{
    use HasFactory;

    public function getToken()
    {
        return Crypt::encryptString($this->id);
    }

    public function isExpired()
    {
        return Carbon::now()->gt($this->updated_at->addMinutes(10));
    }

    public function isEmailVerified()
    {
        return !is_null($this->email_verified_at);
    }

    public function isPhoneVerified()
    {
        return !is_null($this->phone_verified_at);
    }
}
