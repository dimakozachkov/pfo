<?php

namespace App\Models;

use Storage;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Template
 * @package App\Models
 *
 * @property string $url
 * @property string $title
 */
class Template extends Model
{
	
	protected $fillable = [
		'url', 'title',
	];
	
	protected static function boot()
	{
		parent::boot();
		
		static::deleting(function ($template) {
			Storage::disk('public')->delete("photos/{$template->url}");
		});
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
	
}
