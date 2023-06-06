<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\BloodTypeClient;
use App\Models\Category;
use App\Models\Governorate;
use App\Models\City;
use App\Models\Client;
use App\Models\ClientGovernorate;
use App\Models\Contact;
use App\Models\Post;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;



class MainController extends Controller
{
    public function governorates()
    {
        $governorates = Governorate::all();
        return responseJson(1, "success", $governorates);
    }
    public function cities(Request $request)
    {
        $cities = City::where(function ($query) use ($request) {
            if ($request->has('governorate_id')) {
                 $query->where('governorate_id', $request->governorate_id);
            }
        })->get();

        return responseJson(1, "success", $cities);
    }
    public function posts(Request $request)
    {

        $search=$request->search;
        $posts = Post::where(function ($query) use ($request,$search) {    //if the func is empty where will be neglected because no conditions added
            if ($request->has('search')) {
                $query->where('title', 'like', "%$search%")
               ->orWhere('content', 'like', "%$search%");
            }
        })->with('category')->get();

        return responseJson(1, "success", $posts);
    }
    public function postDetails(Request $request)
    {
        $post = Post::with('category')->find($request);
        return responseJson(1, "success", $post);
    }
    public function getFav(  )
    {

         $client = Auth::user();
         $fav=$client->posts()->latest()->paginate(5);
        return responseJson(1, "success", $fav);
    }
    public function setFav(Request $request)
    {
        $client = Auth::user();
        $validator = Validator::make($request->all(), [

            'post_id' => 'required|exists:posts,id'
        ]);

        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }
        $toggle = $client->posts()->toggle($request->post_id);
        return responseJson(1, "success", $toggle);
    }
    public function categories()
    {
        $categories = Category::all();
        return responseJson(1, "success", $categories);
    }
    public function bloodTypes()
    {
        $bloodTypes = BloodType::all();
        return responseJson(1, "success", $bloodTypes);
    }
    public function settings()
    {
        $settings = Setting::first(); //first
        return responseJson(1, "success", $settings);
    }
    public function editProfile(Request $request)
    {
        $client = Auth::user();
        $keys = $request->keys();

        if (count($keys) === 1 && $request->has('api_token')) {
            return responseJson(1, "success", $client);
        } else {
            $validator = Validator::make($request->all(), [

                'password' => 'confirmed',
                'phone' => 'required',
                'd_o_b' => 'nullable|date',
                'city_id' => 'required',
                'pin_code' => 'required',
                'blood_type_id' => 'required',
                'last_donation_date' => 'nullable|date',
                'email' => 'required',
            ]);

            if ($validator->fails()) {
                return responseJson(0, $validator->errors()->first(), $validator->errors());
            }

            if ($request->filled('password')) {
                $request->merge(['password' => bcrypt($request->password)]);
            }
            $client->email = $request['email'];
            $client->d_o_b = $request['d_o_b'];
            $client->phone = $request['phone'];
            $client->password = $request['password'];
            $client->blood_type_id = $request['blood_type_id'];
            $client->pin_code = $request['pin_code'];
            $client->last_donation_date = $request['last_donation_date'];
            $client->city_id = $request['city_id'];
            $client->save();

            return responseJson(1, "new client added", [
                'api_token' => $client->api_token,
                'client' => $client,

            ]);
        }
    }
    public function contacts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        $contact = Contact::create($request->all());


        return responseJson(1, "new contact added", [
            'api_token' => $request['api_token'],
            'contact' => $contact,

        ]);
    }
    public function getNotificationSettings()
    {
        $client = Auth::user();

        $bloodTypes = $client->bloodTypes;
        $bloodTypeNames = $bloodTypes->pluck('name')->toArray();
        $governorates = $client->governorates;
        $governoratesNames = $governorates->pluck('name')->toArray();

        return responseJson(1, "success", [
            'bloodTypes' => $bloodTypeNames,
            'governorates' => $governoratesNames
        ]);
    }
    public function getNotifications()
    {
        $client = Auth::user();
        $notifications=$client->notifications()->latest()->paginate(5);

        return responseJson(1, "success", $notifications);
    }
    public function updateNotificationSettings(Request $request)
    {

        $client=$request->user();//if there was no request use Auth::user();

        $client->bloodTypes()->sync($request->bloodTypesIds);
        $bloodTypes = $client->bloodTypes;
        $bloodTypeNames = $bloodTypes->pluck('name')->toArray();

        $client->governorates()->sync($request->governoratesIds);
        $governorates = $client->governorates;
        $governoratesNames = $governorates->pluck('name')->toArray();
        return responseJson(1, "success", [
            'bloodTypes' => $bloodTypeNames,
            'governorates' => $governoratesNames
        ]);
    }
    public function createDonation(Request $request)
    {

        $client=$request->user(); // it knows the guard from middleware and if we used auth::user it will get the default guard which is api since we are using api route
        $validator = Validator::make($request->all(), [


          'patient_name' => 'required',
          'patient_phone' => 'required',
          'city_id' => 'required|exists:cities,id',
          'hospital_name' => 'required',
          'blood_type_id' => 'required',
          'patient_age' => 'required|digits:2',
          'bags_num' => 'required|integer',
          'hospital_address' => 'required',
          'details' => 'required',
        ]);

        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        $donationRequest= $client->donationRequests()->create($request->all());
        $clientIds=$donationRequest->city //fetch since no ()
        ->governorate                     //fetch since no ()
        ->clients()->whereHas('bloodTypes',function($query) use($request){//since i want to make a condition on the clients will use brackets  ,,,,  wherehas applies a condition on collection relation ,,,,, a closure is used to write a condtion more freely in php
            $query->where('blood_types.id',$request->blood_type_id); // blood_types table name
        })->pluck('clients.id')->toArray();
         //dd($clientIds); dump and die
        $bloodtypename=BloodType::where('id',$donationRequest->blood_type_id)->pluck('name');

         if (count($clientIds) ){
            $notification = $donationRequest->notifications()->create([
                'title'=> 'احتاج متبرع A+' ,
                'content'=> $bloodtypename .  'احتاج متبرع '
            ]);
            $notification->clients()->attach($clientIds);

            $tokens=$client->tokens()->where('token','!=','')
            ->whereIn('client_id',$clientIds)->pluck('token')->toArray();

            if (count($tokens)){
                $title = $notification->title;
                $body =  $notification->content;
                $data = [
                    'donation_request_id'=> $donationRequest->id
                ];
                $send = notifyByFirebase($title, $body, $tokens, $data, true);
                info('firebase result:'.$send);
            }





         }

         return responseJson(1, "successfully added", $send);

    }

}
