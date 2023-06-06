<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records=Category::all();
        return view('category.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    //    dd($request->all());
       $this->validate($request,[
        'name' => 'required|'
       ]);
       $record= new Category;
        $record->name=$request->name;
      $record->save();
      // $gov = Governorate::create(['name' => $request->name,]); //another way no  need for save since it automatically saves
    // $city = City::create($request->all()); another way
        flash("successfully added <strong> $record->name</strong>")->success();
       return redirect(route('category.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    //    $model= Governorate::where('id',$id)->get();
    //    $model= Governorate::where('id',$id)->first();
       $model= Category::findOrFail($id);

       return view('category.edit',compact('model'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'name' => 'required|'
           ]);
           $model= Category::findOrFail($id);
        //     $model->name=$request->name;
        //   $model->save();

           $model->update($request->all());

            flash("successfully updated <strong> $model->name</strong>")->success();
           return redirect(route('category.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $model= Category::findOrFail($id);
         $model->delete();
         flash("successfully deleted <strong> $model->name</strong>")->success();
           return back();
    }
}
