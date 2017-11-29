<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wishlist;

class WishlistController extends Controller
{
	/**
	 * Create a new controller instance
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth', ['except' => ['index', 'show']]);
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$wishlists = Wishlist::orderBy('created_at')->get();
		
		return view('wishlist.index')->with('wishlists', $wishlists);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('wishlist.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$this->validate($request, [
			'title' => 'required'
		]);

		if (count(auth()->user()->wishlist) > 0){
			return back()->with('error', 'Du kan desværre kun have en ønskeseddel');
		}
		$title = $request->input('title');

		$wishlist = new Wishlist;
		$wishlist->title = $title; 
		$wishlist->user_id = auth()->user()->id;
		$wishlist->save();

		return redirect('/wishlists/' . $wishlist->id . '/edit')->
				with('success', '"' . $title . '"' . ' blev oprettet');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$wishlist = Wishlist::find($id);

		$data = array(
			'wishlist' => $wishlist,
			'info' => 'OBS. Du kan trykke på hvert ønske for at se mere'
		);

		return view('wishlist.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$wishlist = Wishlist::find($id);
		
		// Check for correct user
		if(auth()->user()->id !== $wishlist->user_id){
			return redirect('home')->with('error', 'Du har ikke adgang til denne side');	
		}	
		return view('wishlist.edit')->with('wishlist', $wishlist);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$this->validate($request, [
			'title' => 'required'
		]);

		$wishlist = Wishlist::find($id);
		
		// Check for correct user
        if(auth()->user()->id !== $wishlist->user_id){
          	return back()->with('error', 'Du har ikke adgang til denne side');
       	}
		
		$wishlist->title = $request->input('title');	
		$wishlist->save();

		return redirect('/wishlists/' . $id . '/edit')->with(
				'success', 'Ændringerne blev gemt');	
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wishlist = Wishlist::find($id);
        //Check for correct user
        if(auth()->user()->id !== $wishlist->user_id){
          	return back()->with('error', 'Du har ikke adgang til denne side');
       	}
        
        $wishlist->delete();
        return back()->with('success', 'Ønskesedlen blev slettet');
    }
}
