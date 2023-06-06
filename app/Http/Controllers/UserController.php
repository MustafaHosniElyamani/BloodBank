<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class UserController extends Controller
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
        // $user = auth()->user();

        $records = User::all();

        return view('user.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //  dd($request->all());
        $this->validate($request, [
            'roles' => 'required|array',
            'name' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ]);
        $request->merge(['password' => bcrypt($request->password)]);
        $record = User::create($request->all());
        $record->syncRoles($request->input('roles', []));


        // $record = new Role;
        // $record->name = $request->name;
        // $record->save();
        // $gov = Governorate::create(['name' => $request->name,]); //another way no  need for save since it automatically saves
        // $city = City::create($request->all()); another way
        flash("successfully added <strong> $record->name</strong>")->success();
        return redirect(route('user.index'));
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
        $model = User::findOrFail($id);


        return view('user.edit', compact('model',));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'roles' => 'required|array',
            'name' => 'required|unique:users,name,'.$id,
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ]);
        $model = User::findOrFail($id);
        //     $model->name=$request->name;
        //   $model->save();

        if ($request->filled('password')) {
            $request->merge(['password' => bcrypt($request->password)]);
            $model->update($request->all());
        } else {
            $model->update($request->except('password'));
        }
        $model->syncRoles($request->input('roles', []));

        flash("successfully updated <strong> $model->name</strong>")->success();
        return redirect(route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = User::findOrFail($id);
        $model->delete();
        flash("successfully deleted <strong> $model->name</strong>")->success();
        return back();
    }
}
