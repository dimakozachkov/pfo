<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Template extends Model
    {

        protected $fillable = [
            'url', 'title'
        ];

        protected static function boot()
        {
            parent::boot();

            static::deleting(function ($template) {
                \Storage::disk('public')->delete("photos/{$template->url}");
            });
        }

    }
