<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
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



        $records = Contact::query()
        ->when($request->input('phone'), function ($query) use($request) {
            return $query->where('phone', $request->phone);
        })
        ->when($request->input('email'), function($query) use($request) {
            return $query->where('email', $request->email);
        })
        ->when($request->input('name'), function($query) use($request) {
            return $query->where('name', 'like', '%' . $request->input('name') . '%');
        })
        ->when($request->input('sort')==='desc' , function ($query) {
            return $query->orderBy('created_at','desc');})

        ->when($request->input('sort')==='asc' , function ($query) {
            return $query->orderBy('created_at','asc');})
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


        return view('contact.index', compact('records'));
    }
    /**
     * Show the form for creating a new resource.
     */

public function destroy(string $id)
{
     $model= Contact::findOrFail($id);
     $model->delete();
     flash("successfully deleted <strong> $model->name</strong>")->success();
       return back();
}
}
