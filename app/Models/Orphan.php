<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class Orphan extends Model
{

    protected $fillable = [
        'first_name', 'last_name', 'address',
        'birthday', 'class', 'country_id',
        'about',
    ];

    protected $with = [
        'country',
    ];

    protected $perPage = 15;

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
        if ($request->exists('search')) {
            $query->where('first_name', 'LIKE', "%{$request->input('search')}%")
                ->orWhere('last_name', 'LIKE', "%{$request->input('search')}%");
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

    public function setBirthdayAttribute($date)
    {
        $this->attributes['birthday'] = Carbon::parse($date);
    }
}
