<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Residence
 * @package App\Models
 *
 * @property int    $country_id
 * @property string $title
 */
class Residence extends Model
{
	protected $fillable = [
		'country_id', 'title',
	];
	
	protected $perPage = 15;
	
	/**
	 * Get orphans
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function orphans()
	{
		return $this->hasMany(Orphan::class);
	}
	
	/**
	 * Get a country
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function country()
	{
		return $this->belongsTo(Country::class);
	}
	
	/**
	 * @param         $query
	 * @param Request $request
	 *
	 * @return mixed
	 */
	public function scopeFilter($query, Request $request)
	{
		if ($request->has('search')) {
			$query->where('title', 'LIKE', "%{$request->input('search')}%");
		}
		
		if ($request->has('country')) {
			$query->where('country_id', 'LIKE', "%{$request->input('country')}%");
		}
		
		return $query;
	}
}
