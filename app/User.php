<?php

namespace App;

use App\Notifications\MailResetPasswordToken;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const USER       = 1;
    const ADMIN      = 2;
    const SUPERADMIN = 3;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'first_name', 'last_name', 'points', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table = 'users';

    public function isAdmin(){
        if ($this->role == User::ADMIN || $this->role == User::SUPERADMIN)
            return true;
        return false;
    }

    public function isSuperAdmin(){
        if ($this->role == User::SUPERADMIN)
            return true;
        return false;
    }

    public function getSolvedEx(){
        return DB::table('users_to_exercise')
            ->where([['user_id', $this->id],['solved', true]])
            ->pluck('ex_id')
            ->toArray();
    }

    /**
     * Send a password reset email to the user
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordToken($token));
    }

}
