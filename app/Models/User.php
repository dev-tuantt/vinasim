<?php

namespace App\Models;

use App\Constants\UserRole;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
	use Notifiable;

	protected $fillable = [
		'name',
		'email',
		'role',
		'password',
	];

	protected $hidden = [
		'password',
		'remember_token',
	];

	protected $casts = [
		'email_verified_at' => 'datetime',
		'role' => 'integer',
	];

	public function isAdmin(): bool
	{
		return UserRole::isAdmin($this->role);
	}
}