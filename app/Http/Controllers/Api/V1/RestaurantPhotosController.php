<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\ApiControllerTrait;
use App\RestaurantPhoto;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class RestaurantPhotosController extends Controller
{
    use ApiControllerTrait;

    protected $model;
    protected $rules = [
        'url' => 'required',
        'restaurant_id' => 'required'
    ];
    protected $messages = [
        'required' => ':attribute é obrigatório',
    ];

    public function __construct(RestaurantPhoto $model)
    {
        $this->model = $model;
    }

    public function index(Request $request, $id)
    {
        $results =  $this->model
            ->where('restaurant_id', $id)
            ->get();
        
            return response()->json($results);
    }
}
