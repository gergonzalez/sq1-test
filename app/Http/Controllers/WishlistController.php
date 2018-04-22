<?php
/**
 * Manage requests to '/wishlist/*'.
 *
 * @author     German Gonzalez Rodriguez <ger@gergonzalez.com>
 * @copyright  German Gonzalez Rodriguez
 *
 * @version    1.0
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Wishlist;
use App\Product;
use Auth;

class WishlistController extends Controller
{
    /**
     * Show the view displaying the logged user list of wishlist products.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Auth::user()->products()->orderBy('created_at','desc')->paginate(28);

        $url = url()->previous();

        return view('wishlist', compact('products', 'url'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        // $validatedData = $request->validate([
        //     'title' => 'required|unique:posts|max:255',
        //     'body' => 'required',
        // ]);

        Auth::user()->products()->attach($product->id);

        return redirect('wishlist')->with('status', __('Product :name added to your wishlist',['name'=> $product->name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function show(Wishlist $wishlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Auth::user()->products()->detach($product->id);

        return back()->with('status', __('Product :name has been removed from your wishlist',['name'=> $product->name]));
    }
}
