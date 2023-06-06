<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        $model=Setting::first();
        return view('settings.edit',compact('model'));
    }
    public function update(Request $request)
    {


            $record = Setting::firstOrCreate([], $request->all());


            $record->update($request->all());


            flash("successfully updated <strong> $record->name</strong>")->success();
           return back();
    }

}
