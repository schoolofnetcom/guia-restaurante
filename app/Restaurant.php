<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = ['name', 'description', 'photo', 'phone', 'user_id'];
    protected $appends = ['photo_full_url'];

    protected function getPhotoFullUrlAttribute()
    {
        if (!empty($this->attributes['photo'])) {
            return 'https://s3-'.env('AWS_REGION').'.amazonaws.com/'.env('AWS_BUCKET').'/restaurante/'.$this->attributes['photo'];
        } else {
            return null;
        }
    }

    public function address()
    {
        return $this->hasOne(\App\Address::class);
    }
}