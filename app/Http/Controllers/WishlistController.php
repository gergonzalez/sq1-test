<?php
/**
 * Manage requests to '/wishlists/*'.
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
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Auth::user()->products();

        $products = $this->sort($request, $products);

        $products = $products->paginate(28);

        //Not asked and makes another call to db but it is funny :)
        $cost = Auth::user()->products()->sum('price');

        return view('my-wishlist', compact('products', 'cost'));
    }

    /**
     * Store a product in a wishlist.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        Auth::user()->products()->attach($product->id);

        //Store previous url to come back
        $request->session()->put('previous', url()->previous() );

        return redirect('wishlists')->with('status', __('Product :name added to your wishlist',['name'=> $product->name]));
    }

    /**
     * Display the specified wishlist.
     *
     * @param  \App\Wishlist  $wishlist
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Wishlist $wishlist)
    {
        if(Auth::check() && Auth::user()->id === $wishlist->user_id){
            return redirect('wishlists');
        }

        $products = $wishlist->products();

        $products = $this->sort($request, $products);

        $products = $products->paginate(28);

        $alreadyWishlist = null;

        if (Auth::check()) {
            $alreadyWishlist = Auth::user()->products()->pluck('products.id')->all();
        }

        //Not asked and makes another call to db but it is funny :)
        $cost = $wishlist->products()->sum('price');

        return view('wishlist', compact('wishlist','products', 'cost', 'alreadyWishlist'));
    }

    /**
     * Remove the specified product from the wishlist.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Auth::user()->products()->detach($product->id);

        return back()->with('status', __('Product :name has been removed from your wishlist',['name'=> $product->name]));
    }

    /**
     * Helper method to reuse it in several palces
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * 
     * @return \Illuminate\Http\Response
     */
    private function sort($request, $products)
    {
        if ($request->has('sort') && $request->query('sort') === 'price_desc'){
            return $products->orderBy('price','asc');

        } else if ($request->has('sort') && $request->query('sort') === 'price_asc' ){
            return $products->orderBy('price','desc');
        
        } else if ($request->has('sort') && $request->query('sort') === 'name_desc' ){
            return $products->orderBy('name','asc');
        
        } else if ($request->has('sort') && $request->query('sort') === 'name_asc' ){
            return $products->orderBy('name','desc');
        
        } else{
            return $products->orderBy('pivot_created_at','desc');
        
        }
    }

}
