<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\ApiControllerTrait;
use App\Restaurant;
use Laravel\Lumen\Routing\Controller;

class RestaurantsController extends Controller
{
    use ApiControllerTrait;

    protected $model;

    public function __construct(Restaurant $model)
    {
        $this->model = $model;
    }
}