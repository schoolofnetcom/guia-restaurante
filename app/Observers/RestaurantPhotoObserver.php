<?php

namespace App\Observers;

use App\RestaurantPhoto;

class RestaurantPhotoObserver
{
    use UploadObserverTrait;

    protected $field = 'url';
    protected $path = 'restaurant_photo/';

    public function creating(RestaurantPhoto $model)
    {
        $this->sendFile($model);
    }

    public function deleting(RestaurantPhoto $model)
    {
        $this->removeFile($model);
    }

    public function updating(RestaurantPhoto $model)
    {
        $this->updateFile($model);
    }
}