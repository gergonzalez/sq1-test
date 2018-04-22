<?php
/**
 * Manage requests to '/'.
 *
 * @author     German Gonzalez Rodriguez <ger@gergonzalez.com>
 * @copyright  German Gonzalez Rodriguez
 *
 * @version    1.0
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application landing/home.
     * 
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('sort') && $request->query('sort') === 'price_desc'){
            $products = Product::orderBy('price','asc')->paginate(28);

        } else if ($request->has('sort') && $request->query('sort') === 'price_asc' ){
            $products = Product::orderBy('price','desc')->paginate(28);
        
        } else if ($request->has('sort') && $request->query('sort') === 'name_desc' ){
            $products = Product::orderBy('name','asc')->paginate(28);
        
        } else if ($request->has('sort') && $request->query('sort') === 'name_asc' ){
            $products = Product::orderBy('name','desc')->paginate(28);
        
        } else{
            $products = Product::paginate(28);
        
        }

        $alreadyWishlist = null;

        if (Auth::check()) {
            $alreadyWishlist = Auth::user()->products()->pluck('products.id')->all();
        }

        return view('home', compact('products','alreadyWishlist'));

    }
}
