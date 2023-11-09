<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //show all listings
    public function index() {
        return view('listings.index', [
            // 'listings' => Listing::all(),
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->get()//latest() is a query scope
        ]);
    }

    //show single listing
    public function show(Listing $listing) {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    //show Create form
    public function create() {
        return view('listings.create');
    }

    //store listing data
    public function store(Request $request) {
        // dd($request);
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'email' => ['required', 'email'],
            'website' => 'required',
            'description' => 'required|min:20',
            'tags' => 'required'
        ]);

        Listing::create($formFields);

        return redirect('/');
    }
}
