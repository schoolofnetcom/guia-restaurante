<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\ApiControllerTrait;
use App\Address;
use App\Restaurant;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;
use AnthonyMartin\GeoLocation\GeoLocation;

class RestaurantsController extends Controller
{
    use ApiControllerTrait;

    protected $model;
    protected $rules = [
        'name' => 'required|min:3',
        'description' => 'required'
    ];
    protected $messages = [
        'required' => ':attribute é obrigatório',
        'min' => ':attribute precisa de pelo menos :min caracteres'
    ];
    protected $relationships = ["address"];

    public function __construct(Restaurant $model)
    {
        $this->model = $model;
    }

    public function store(Request $request)
    {
        $this->authorize('create', Restaurant::class);

        $this->validate($request, $this->rules ?? [], $this->messages ?? []);

        $data = $request->all();
        $data['user_id'] = $request->user()->id;
        
        $result = $this->model->create($data);
        return response()->json($result);
    }

    public function address(Request $request, $id)
    {
        $restaurant = $this->model->findOrFail($id);
        $address = $restaurant->address;

        if (!$address) {
            $address = \App\Address::create($request->all());
        } else {
            $address->update($request->all());
        }
        $restaurant->address()->save($address);
        return response()->json($address);
    }

    public function upload(Request $request, $id)
    {
        $result = $this->model->findOrFail($id);
        $data['photo'] = $request->file('photo');
        $result->update($data);
        return response()->json($result);
    }

    public function getByAddress(Request $request)
    {
        $location = $request->input('address');
        $limit_km = $request->input('limit') ?? 10;

        $response = GeoLocation::getGeocodeFromGoogle($location);

        if (!empty($response->results) and is_array($response->results)) {
            $result = array_pop($response->results);
            $latitude = $result->geometry->location->lat;
            $longitude = $result->geometry->location->lng;

            $restaurants = Address::select(\DB::raw("id, latitude, longitude, restaurant_id, ( 6371 * acos( cos( radians({$latitude}) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians({$longitude}) ) + sin( radians({$latitude}) ) * sin( radians( latitude ) ) ) ) AS distance"))
                ->orderBy('distance')
                ->having('distance', '<=', $limit_km)
                ->having('restaurant_id', '>', 0)
                ->limit(20)
                ->with(['restaurant'])
                ->get();
        
            $status = 'success';

            return compact('restaurants', 'latitude', 'longitude', 'status');
        }

        $status = 'error';
        return  compact('status');
    }

    public function getByCoords(Request $request)
    {
        $limit_km = $request->input('limit') ?? 10;

        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        $restaurants = Address::select(\DB::raw("id, latitude, longitude, restaurant_id, ( 6371 * acos( cos( radians({$latitude}) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians({$longitude}) ) + sin( radians({$latitude}) ) * sin( radians( latitude ) ) ) ) AS distance"))
            ->orderBy('distance')
            ->having('distance', '<=', $limit_km)
            ->having('restaurant_id', '>', 0)
            ->limit(20)
            ->with(['restaurant'])
            ->get();
    
        $status = 'success';

        return compact('restaurants', 'latitude', 'longitude', 'status');
    }

    public function viewPhone(Request $request, $id)
    {
        /**
         * $request->ip();
         **/
        $restaurant = $this->model->findOrFail($id);
        $restaurant->phone_count = $restaurant->phone_count + 1;
        $restaurant->update();

        return ['status'=>'success'];
    }
}
