<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {



        $records = Client::query()
        ->when($request->input('blood_type_id'), function ($query) use($request) {
            return $query->where('blood_type_id', $request->blood_type_id);
        })
        ->when($request->input('city_id'), function($query) use($request) {
            return $query->where('city_id', $request->city_id);
        })
        ->when($request->input('sort')==='ldd_desc' , function ($query) {
            return $query->orderBy('last_donation_date','desc');})

        ->when($request->input('sort')==='ldd_asc' , function ($query) {
            return $query->orderBy('last_donation_date','asc');})
        ->get();


        // $records = Client::where(function ($query) use ($request) {
        //     if ($request->has('blood_type_id')&&$request->input('blood_type_id') != null) {
        //           $query->where('blood_type_id', $request->blood_type_id);
        //     }
        //     if($request->has('city_id')&&$request->input('city_id') != null){
        //           $query->where('city_id', $request->city_id);
        //     }
        //     if (  $request->input('sort') === 'ldd_desc')  {
        //           $query->orderBy('last_donation_date','desc');
        //     } elseif ( $request->input('sort') === 'sort_asc') {
        //          $query->orderBy('last_donation_date','asc');
        //     }
        // })->get();


        return view('client.index', compact('records'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function toggleActive(Client $client)
{
    $client->is_active = ! $client->is_active;
    $client->save();

    flash("successfully updated <strong> $client->phone</strong>")->success();
           return back();
}
public function destroy(string $id)
{
     $model= Client::findOrFail($id);
     $model->delete();
     flash("successfully deleted <strong> $model->name</strong>")->success();
       return back();
}
}
