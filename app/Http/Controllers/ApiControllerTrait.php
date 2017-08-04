<?php

namespace App\Http\Controllers;

trait ApiControllerTrait
{
    public function index()
    {
        $results = $this->model->paginate();
        return response()->json($results);
    }
}