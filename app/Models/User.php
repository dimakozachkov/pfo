<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\User
 *
 * @property string $name
 * @property string $email
 * @property string $password
 * @property int    $country_id
 * @property int    $role
 * @property string $login
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[]
 *                $notifications
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
	use Notifiable;
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password',
		'country_id', 'role', 'login',
	];
	
	/**
	 * @var int
	 */
	protected $perPage = 15;
	
	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];
	
	/**
	 * Relationship to a country
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function country()
	{
		return $this->belongsTo(Country::class);
	}
	
	/**
	 * Set an user role
	 *
	 * @param int $role
	 *
	 * @return User
	 */
	public function setRole(int $role): self
	{
		$this->role = $role;
		$this->save();
		
		return $this;
	}
	
	/**
	 * @param $query
	 * @param $request
	 *
	 * @return mixed
	 */
	public function scopeFilter($query, $request)
	{
		if ($request->exists('search')) {
			$query->where('name', 'LIKE', '%' . $request->input('search') . '%')
				->orWhere('email', 'LIKE', '%' . $request->input('search') . '%');
		}
		
		return $query;
	}
}
