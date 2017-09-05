<?php

namespace App\Observers;

use App\Dish;

class DishObserver
{
    use UploadObserverTrait;

    protected $field = 'photo';
    protected $path = 'dishes/';

    public function creating(Dish $model)
    {
        $this->sendFile($model);
    }

    public function deleting(Dish $model)
    {
        $this->removeFile($model);
    }

    public function updating(Dish $model)
    {
        $this->updateFile($model);
    }
}
