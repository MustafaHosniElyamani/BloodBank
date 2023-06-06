<?php

namespace App\Http\Controllers;

use App\Models\DonationRequest;
use Illuminate\Http\Request;

class DonationRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {



        $records = DonationRequest::query()
        ->when($request->input('city_id'), function ($query) use($request) {
            return $query->where('city_id', $request->city_id );
        })
        ->when($request->input('blood_type_id'), function ($query) use($request) {
            return $query->where('blood_type_id', $request->blood_type_id  );
        })
        ->when($request->input('patient_phone'), function($query) use($request) {
            return $query->where('patient_phone', $request->patient_phone);
        })
        ->when($request->input('patient_name') , function($query) use($request) {
            return $query->where('patient_name', 'like', '%' . $request->input('patient_name') . '%');
        })
        ->when($request->input('hospital_name'), function($query) use($request) {
            return $query->where('hospital_name', 'like', '%' . $request->input('hospital_name') . '%');
        })
        ->when($request->input('sort')==='desc' , function ($query) {
            return $query->orderBy('created_at','desc');})

        ->when($request->input('sort')==='asc' , function ($query) {
            return $query->orderBy('created_at','asc');})
        ->when($request->input('age')==='desc' , function ($query) {
            return $query->orderBy('patient_age','desc');})

        ->when($request->input('age')==='asc' , function ($query) {
            return $query->orderBy('patient_age','asc');})
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


        return view('donation.index', compact('records'));
    }
    /**
     * Show the form for creating a new resource.
     */

public function destroy(string $id)
{
     $model= DonationRequest::findOrFail($id);
     $model->delete();
     flash("successfully deleted <strong> $model->patient_name</strong>")->success();
       return back();
}

    public function show(string $id)
    {
        $model= DonationRequest::findOrFail($id);


        return view('donation.show', compact('model'));
    }


}
