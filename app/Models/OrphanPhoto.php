<?php

namespace App\Models;

use App\Attributes\OrphanPhotoAttributes;
use Illuminate\Database\Eloquent\Model;

class OrphanPhoto extends Model
{

    protected $fillable = [
        'orphan_id', 'url', 'weight', 'main',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($photo) {
            \Storage::disk('public')->delete("photos/{$photo->url}");
        });
    }

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
     * Set the photo as main photo
     *
     * @return OrphanPhoto
     */
    public function asMain(): self
    {
        $this->main = OrphanPhotoAttributes::MAIN;
        $this->save();

        return $this;
    }

    /**
     * Set the photo as not main photo
     *
     * @return OrphanPhoto
     */
    public function asNotMain(): self
    {
        $this->main = OrphanPhotoAttributes::NOT_MAIN;
        $this->save();

        return $this;
    }

}
