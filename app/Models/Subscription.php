<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Subscription
 *
 * @package App\Models
 *
 * @property int $id
 * @property int $user_id
 * @property int $orphan_id
 */
class Subscription extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'user_id', 'orphan_id',
    ];

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function orphans(): BelongsToMany
    {
        return $this->belongsToMany(Orphan::class);
    }

}
