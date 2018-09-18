<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Class Country
 * @package App\Models
 *
 * @property string $code
 * @property string $title
 */
class Country extends Model
{
    protected $fillable = [
        'code', 'title',
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
     * Get residences
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function residences()
    {
        return $this->hasMany(Residence::class);
    }

    /**
     * Get a random orphan
     *
     * @return Model|\Illuminate\Database\Eloquent\Relations\HasMany|\Illuminate\Database\Query\Builder|null|object
     */
    public function randomOrphan()
    {
        return $this->orphans()->orderByRaw("RAND()")
            ->take(1)
            ->first();
    }

    public function scopeFilter($query, Request $request)
    {
        if ($request->exists('search')) {
            $query->where('title', 'LIKE', "%{$request->input('search')}%");
        }

        return $query;
    }
}
