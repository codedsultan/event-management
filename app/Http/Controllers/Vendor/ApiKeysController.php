<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\ApiKey;
use Illuminate\Http\Request;

class ApiKeysController extends Controller
{
        /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {
        // $data = [
        //     'name' => 'James',
        //     'contact' => [
        //         'phone' => [
        //             'work_phone' => '000',
        //             'home_phone' => '111'
        //         ],
        //         'emails' => 'james@test',
        //     ]
        // ];
        // $data = [
        //     'key_one' => 1,
        //     'key_two' => 2,
        //     'nested_array' => [
        //         'key_three' => 3,
        //         'key_four' => 4,
        //         ]
        //     ];

        // dd(...$data);
        // dd(static::flatten($data));
        // dd($this->flatten($data));
        $key = ApiKey::where('vendor_id',$request->user()->id)->first();
        return view('dashboard.vendor.apikey.index', compact('key'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create(Request $request)
    {
        return view('dashboard.vendor.apikey.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store(Request $request)
    {
        $data =  $request->validate([
            'stripe_secret' => ['required','string'],
        ]);
        // dd($request->user()->id);
        $key = ApiKey::firstOrCreate(['vendor_id' => $request->user()->id],
        ['stripe' => $data['stripe_secret']
        ]);

        return redirect()->route('vendor.stripe.key.index')->with('success', 'Api key saved successfully');


    }


     /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function delete(ApiKey $key,Request $request)
    {
        // dd($key);
        $key->delete();

        return redirect()->back()->with('success', 'Api key deleted successfully');

    }
    // public static function flatten(array $array): array
    // {


    //     return array_reduce(array_keys($array),fn($carry,$key) => is_array($array[$key]) ? [...$carry,...static::flatten($array[$key])] : [...$carry,...[$key => $array[$key]]],[]);
    // }

    // function flatten($array) {
    //     $results = [];

    //     foreach ($array as $key => $value) {
    //         if (is_array($value) && ! empty($value)) {
    //             $results = array_merge($results, $this->flatten($value));
    //         } else {
    //             $results[$key] = $value;
    //         }
    //     }

    //     return $results;
    // }

}
