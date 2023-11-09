<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //show all listings
    public function index() {
        // dd(Listing::latest()->filter(request(['tag', 'search']))->paginate(2));
        return view('listings.index', [
            // 'listings' => Listing::all(),
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)//latest() is a query scope
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
        // dd($request->file('logo')->store());
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'email' => ['required', 'email'],
            'website' => 'required',
            'description' => 'required|min:20',
            'tags' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->user()->id;

        Listing::create($formFields);

        // Session::flash('message', 'Your listing has been added!');

        return redirect('/') ->with('message', 'Listing created successfully!');
    }

    //show edit form
    public function edit(Listing $listing) {
        // dd($listing->id);
        return view('listings.edit', ['listing' => $listing]);
    }

    //update listing

    public function update(Request $request, Listing $listing) {
        // dd($listing->id);

        //make sure logged in user is owner
        if($listing->user_id != auth()->id()) {
            abort(403, "Unauthorized");
        }

        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'email' => ['required', 'email'],
            'website' => 'required',
            'description' => 'required|min:20',
            'tags' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        // Session::flash('message', 'Your listing has been added!');

        return redirect('/listings/' . $listing->id) ->with('message', 'Listing created successfully!');
    }

    //delete listing
    public function delete(Listing $listing) {
        //make sure logged in user is owner
        if($listing->user_id != auth()->id()) {
            abort(403, "Unauthorized");
        }

        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully!');
    }

    //Manage Listings
    public function manage() {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
