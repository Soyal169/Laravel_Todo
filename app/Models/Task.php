<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class Task extends Model implements HasMedia
{
    use InteractsWithMedia;

    //
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        // Create a conversion called 'thumb' that resizes images to 100x100px
        $this->addMediaConversion('thumb')
            ->width(100)
            ->height(100);
    }
    public function getMediaDirectory(): string
    {
        // Store the media files in a directory with the post ID as the name
        return 'tasks/' . $this->id;
    }
    public function registerMediaCollections(): void
    {
        // Create a collection called 'images' that only allows a single file
        $this->addMediaCollection('images')->singleFile();
    }
}
