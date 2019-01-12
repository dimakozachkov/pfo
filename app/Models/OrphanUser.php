<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrphanUser
 *
 * @package App\Models
 *
 * @property int $orphan_id
 * @property int $user_id
 */
class OrphanUser extends Model
{

    /**
     * @var string
     */
    protected $table = 'orphan__user';

    /**
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'orphan_id', 'user_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orphans()
    {
        return $this->hasMany(Orphan::class, 'id', 'orphan_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

}
