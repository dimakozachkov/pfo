<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Orphan
 * @package App\Models
 *
 * @property string $first_name
 * @property string $last_name
 * @property string $address
 * @property        $birthday
 * @property int    $class
 * @property int    $country_id
 * @property int    $residence_id
 * @property string $about
 */
class Orphan extends Model
{

	protected $fillable = [
		'first_name', 'last_name', 'address',
		'birthday', 'class', 'country_id',
		'residence_id', 'about',
	];

	protected $with = [
		'country',
	];

	protected $perPage = 12;

	protected $dates = [
		'birthday',
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
	 * Relationship to a residence
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function residence()
	{
		return $this->belongsTo(Residence::class);
	}

	/**
	 * Relationship to photos
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function photos()
	{
		return $this->hasMany(OrphanPhoto::class);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function mainPhoto()
	{
		return $this->hasOne(OrphanPhoto::class)
			->where('main', true);
	}

	/**
	 * Relationship to the statistic
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function statistic()
	{
		return $this->hasMany(DownloadAccount::class);
	}

	protected static function boot()
	{
		parent::boot();

		static::creating(function ($orphan) {
			$authUser = auth()->user();
			$orphan->country_id = $authUser ? $authUser->country_id : 1;
			$orphan->user_id = $authUser ? $authUser->id : 1;
		});

		static::deleting(function ($orphan) {
			$photos = $orphan->photos()->get();

			foreach ($photos as $photo) {
				\Storage::disk('public')->delete("photos/{$photo->url}");
				$photo->delete();
			}
		});
	}


	public function scopeFilter($query, $request)
	{
		if ($request->has('search') && !is_null($request->input('search'))) {
			$query->where('first_name', 'LIKE', '%' . $request->input('search') . '%')
				->orWhere('last_name', 'LIKE', '%' . $request->input('search') . '%')
				->orWhere('id', $request->input('search'));
		}

		if ($request->has('residence_id') && !is_null($request->input('residence_id'))) {
			$query->where('residence_id', $request->input('residence_id'));
		}

		return $query;
	}

	/**
	 * @return mixed
	 */
	public function getOldYearsAttribute()
	{
		return $this->birthday->diffInYears(Carbon::now());
	}

	/**
	 * @return mixed
	 */
	public function getMainPhotoAttribute()
	{
		return optional($this->photos()->where('main', 1)
			->first())
			->url;
	}

	public function getOrphanCodeAttribute()
	{
		$countryCode = $this->country()->first()->code;
		$orphanCode = $this->id . '' . $countryCode;

		return $orphanCode;
	}

	public function getFullNameAttribute()
	{
		return "{$this->first_name} {$this->last_name}";
	}

	public function setBirthdayAttribute($date)
	{
		$this->attributes['birthday'] = Carbon::parse($date)->toDateTimeString();
	}
}
