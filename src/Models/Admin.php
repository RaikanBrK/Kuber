<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Kuber\Mail\Admin\ResetPassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'description',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        Mail::to($this->email)->queue(new ResetPassword($token, $this->name, $this->email));
    }

    public function adminlte_image()
    {
        return asset($this->image());
    }

    public function image()
    {
        return $this->image ?? config('kuber.admin_image_default');
    }

    public function adminlte_desc()
    {
        return $this->desc();
    }

    public function desc()
    {
        return $this->description ?? __(config('kuber.admin_desc_default'));
    }

    public function adminlte_profile_url()
    {
        return 'admin/profile';
    }
}
