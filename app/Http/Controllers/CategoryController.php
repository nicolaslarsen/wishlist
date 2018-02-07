<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Item;

class CategoryController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $uncategorized = auth()->user()->wishlist->items->where('category_id', null);
		return view('category.create')->with('uncategorized', $uncategorized);
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
			'name' => 'required'
		]);
		
		$category = new Category;

		$category->name = $request->input('name');
		$category->user_id = auth()->user()->id;

		$category->save();

		$checkboxes = $request->input('checkbox');
		$ids;
		if (!empty($checkboxes)){
			// Check if all items belong to the user and
			// update category id
			foreach ($checkboxes as $id){
				$item = Item::find($id);

				if ($item->wishlist->user_id === auth()->user()->id){
					$item->category_id = $category->id;

					$item->save();
				}	
			}
		}
		return redirect('/home')->with('success', 
				 '"' . $category->name . '" blev tilføjet til kategorier');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
