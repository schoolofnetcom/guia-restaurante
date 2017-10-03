<?php

namespace App\Http\Controllers\Api\V1;

use Laravel\Lumen\Routing\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class NotificationsController extends Controller
{
    protected $rules = [
        'message' => 'requried|min:10'
    ];
    protected $messages = [
        'required' => ':attribute é obrigatório',
        'min' => ':attribute precisa de pelo menos :min caracteres',
    ];

    public function send(request $request)
    {
        $client = new Client;
        $client->request('POST', 'https://fcm.googleapis.com/fcm/send', [
            'headers' => [
                'Authorization' => 'key=AAAAleFe8Ng:APA91bEQNqyujLc50kRFxZ3-_4-4_4gosj4_odW0DwRKYXuqfj1SiEOBCJ4zlDrMfi2h0b8-7hV5_H8WAG1xUoLsqMx2UVez9BJAUC-8bx8dZ-KWV0m9iBgcKI_bel-xzhVCF3dkYVy8'
            ],
            'json' => [
                'to' => '/topics/restaurant',
                'notification' => [
                    'title' => 'Mensagem para restaurantes',
                    'body' => $request->input('message'),
                    'icon' => 'https://maxcdn.icons8.com/Share/icon/Food//cherry1600.png'
                ]
            ]
        ]);

        return response()->json(['status' => 'success']);
    }

    public function registration(request $request)
    {
        $client = new Client;
        $client->request('POST', 'https://iid.googleapis.com/iid/v1/'. $request->input('token') .'/rel/topics/restaurant', [
            'headers' => [
                'Authorization' => 'key=AAAAleFe8Ng:APA91bEQNqyujLc50kRFxZ3-_4-4_4gosj4_odW0DwRKYXuqfj1SiEOBCJ4zlDrMfi2h0b8-7hV5_H8WAG1xUoLsqMx2UVez9BJAUC-8bx8dZ-KWV0m9iBgcKI_bel-xzhVCF3dkYVy8'
            ],
            'json' => []
        ]);

        return response()->json(['status' => 'success']);
    }
}
