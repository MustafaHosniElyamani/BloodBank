<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\City;
use App\Models\Contact;
use App\Models\DonationRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function home(Request $request)
    {


        if (Auth::guard('front')->check()) {
            // If city_id and blood_type_id are not specified in the request, and the user is authenticated, show their donations only
            $user = Auth::guard('front')->user();
            $posts = $user->posts;
        } else {
            $posts = Post::take(5)->get();
        }
        $bloodtypes = BloodType::all();
        $cities = City::all();

        if ($request->filled('city_id') || $request->filled('blood_type_id')) {
            // If city_id or blood_type_id is specified in the request, show all donations with these filters
            $donations = DonationRequest::query()
                ->when($request->input('city_id'), function ($query) use ($request) {
                    return $query->where('city_id', $request->city_id);
                })
                ->when($request->input('blood_type_id'), function ($query) use ($request) {
                    return $query->where('blood_type_id', $request->blood_type_id);
                })
                ->get();
        } elseif (Auth::guard('front')->check()) {
            // If city_id and blood_type_id are not specified in the request, and the user is authenticated, show their donations only
            $user = Auth::guard('front')->user();
            $donations = $user->donationRequests;
        } else {
            // If city_id and blood_type_id are not specified in the request, and the user is not authenticated, show all donations
            $donations = DonationRequest::all();
        }




        return view('front.home', compact('posts', 'cities', 'bloodtypes', 'donations'));
    }
    public function post(string $id)
    {
        $posts = Post::take(5)->get();
        $post = Post::findOrFail($id);
        return view('front.post', compact('post', 'posts'));
    }
    public function donation(string $id)
    {
        $donations = DonationRequest::take(5)->get();
        $donation = DonationRequest::findOrFail($id);
        return view('front.donation', compact('donation', 'donations'));
    }
    public function about()
    {
        return view('front.about');
    }
    public function contacts()
    {
        return view('front.contacts');
    }
    public function saveContacts(Request $request)
    {
        $this->validate($request, []);
        $contact = Contact::create($request->all());
        flash("successfully added contact")->success();
        return redirect(route('front.contacts'));
    }
    public function donations(Request $request)
    {
        $bloodtypes = BloodType::all();
        $cities = City::all();
        $donations = DonationRequest::query()
            ->when($request->input('city_id'), function ($query) use ($request) {
                return $query->where('city_id', $request->city_id);
            })
            ->when($request->input('blood_type_id'), function ($query) use ($request) {
                return $query->where('blood_type_id', $request->blood_type_id);
            })
            ->paginate(2);
        return view('front.donations', compact('donations', 'bloodtypes', 'cities'));
    }
    public function posts()

    {
        $posts = Post::all();
        return view('front.posts', compact('posts'));
    }
    public function toggleFav(Request $request)
    {
        $user = Auth::guard('front')->user();

        $toggle = $user->posts()->toggle($request->post_id);
        return $toggle;
    }
}
