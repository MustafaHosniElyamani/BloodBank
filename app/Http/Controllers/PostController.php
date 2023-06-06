<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
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
        $records = Post::all();
        return view('post.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //    dd($request->all());
        $this->validate($request, [
            'title' => 'required|',

            'content' => 'required|',
            'category_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',

        ]);








        // Get the uploaded file from the request
        $file = $request->file('image');

        // Generate a unique filename for the uploaded file
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();

        // // Store the file in the public directory
        // $file->move(public_path('images'), $filename);

        // // Get the URL for the stored file
        // $url = asset('images/' . $filename);


 // Store the file in the storage/app/public directory
 $filepath = $file->storeAs('public/images', $filename);

 // Return the public URL of the saved file
 $url= Storage::url($filepath);





        // $imagePath = $request->file('image')->store( 'images', 'public'); // Store the image file in the "public/images" directory

        $record = Post::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'content' => $request->content,
            'image' => $url,
        ]);
        // $gov = Governorate::create(['name' => $request->name,]); //another way no  need for save since it automatically saves
        // $city = City::create($request->all()); another way
        flash("successfully added <strong> $record->name</strong>")->success();
        return redirect(route('post.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = Post::findOrFail($id);

        return view('post.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //    $model= Governorate::where('id',$id)->get();
        //    $model= Governorate::where('id',$id)->first();
        $model = Post::findOrFail($id);

        return view('post.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'title' => 'required|',
            'image' => 'required|',
            'content' => 'required|',
            'category_id' => 'required',
        ]);
        $model = Post::findOrFail($id);
        //     $model->name=$request->name;
        //   $model->save();
          // Get the uploaded file from the request
          $file = $request->file('image');

          // Generate a unique filename for the uploaded file
          $filename = uniqid() . '.' . $file->getClientOriginalExtension();

          // Store the file in the public directory
          $file->move(public_path('images'), $filename);

          // Get the URL for the stored file
          $url = asset('images/' . $filename);
          // $imagePath = $request->file('image')->store( 'images', 'public'); // Store the image file in the "public/images" directory

          $model->update([
              'title' => $request->title,
              'category_id' => $request->category_id,
              'content' => $request->content,
              'image' => $url,
          ]);


        flash("successfully updated <strong> $model->name</strong>")->success();
        return redirect(route('post.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Post::findOrFail($id);
        $model->delete();
        flash("successfully deleted <strong> $model->name</strong>")->success();
        return back();
    }
}
