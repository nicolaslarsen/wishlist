<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ItemController extends Controller
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
		$items = Item::all();

		return view('item.index')->with('items', $items);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('item.create');
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

		$item = new Item;
		$item->title		= $request->input('title');
		$item->link			= $request->input('link');
		$item->body			= $request->input('body');
		$item->wishlist_id	= auth()->user()->wishlist->id;

		$item->category_id = $request->input('category');

		$item->save();
		
		return redirect('/wishlists/' . auth()->user()->wishlist->id . '/edit')->with(
			'success', '"' . $item->title . '"' . ' blev tilføjet');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$item = Item::find($id);
		
		return view('item.show')->with('item', $item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$item = Item::find($id);

		if (auth()->user()->wishlist->id !== $item->wishlist_id)
		{
			return redirect('home')->with('error', 'Du har ikke adgang til denne side'); 
		}

		return view('item.edit')->with('item', $item);
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
			'title' => 'required',
			'link'	=> 'nullable|active_url'
		]);

		$item = Item::find($id);
		
		// Check for correct user
        if(auth()->user()->id !== $item->wishlist->user_id){
          	return back()->with('error', 'Du har ikke adgang til denne side');
       	}
		
		$item->title 	= $request->input('title');	
		$item->link		= $request->input('link');
		$item->body		= $request->input('body');	

		$item->category_id = $request->input('category');

		$item->save();

		return redirect('/wishlists/' . $item->wishlist->id . '/edit')->with(
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

        $item = Item::find($id);
        //Check for correct user
        if(auth()->user()->id !== $item->wishlist->user_id){
          	return back()->with('error', 'Du har ikke adgang til denne side');
       	}
       	$title = $item->title; 
        $item->delete();

		return redirect('/wishlists/' . $item->wishlist->id . '/edit')->with(
			'success', '"' . $title . '"' . ' blev slettet');	
    }
}
