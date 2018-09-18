<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DownloadAccount
 *
 * @package App\Models
 *
 * @property int $id
 * @property int $user_id
 * @property int $orphan_id
 * @property int $template_id
 * @property     $created_at
 * @property     $updated_at
 */
class DownloadAccount extends Model
{
	
	protected $fillable = [
		'user_id', 'orphan_id', 'template_id',
	];
	
	/**
	 * Relationship to the orphan
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function orphan()
	{
		return $this->belongsTo(Orphan::class);
	}
	
	/**
	 * Relationship to the user
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	
	/**
	 * Relationship to the template
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function template()
	{
		return $this->belongsTo(Template::class);
	}
	
}
