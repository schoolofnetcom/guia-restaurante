<?php

namespace App\Http\Controllers\Api\V1;

use Laravel\Lumen\Routing\Controller;
use Illuminate\Http\Request;
use App\RestaurantVote;

class VotesController extends Controller
{
    protected $model;
    protected $rules = [
        'points' => 'required',
        'comment' => 'required|min:3',
        'restaurant_id' => 'required',
    ];
    protected $messages = [
        'required' => ':attribute é obrigatório',
        'min' => ':attribute precisa de pelo menos :min caracteres'
    ];

    public function __construct(RestaurantVote $model)
    {
        $this->model = $model;
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules ?? [], $this->messages ?? []);
        $data = $request->all();
        if ($request->user()) {
            $data['user_id'] = $request->user()->id;
        }
        $result = $this->model->create($data);
        return response()->json($result);
    }
}
