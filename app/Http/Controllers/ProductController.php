<?php
/**
 * Manage requests to 'products/'.
 *
 * @author     German Gonzalez Rodriguez <ger@gergonzalez.com>
 * @copyright  German Gonzalez Rodriguez
 *
 * @version    1.0
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

use CrawlerHelper;

class ProductController extends Controller
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
    public function sync(Request $request)
    {
        $links = [
            'https://www.appliancesdelivered.ie/dishwashers',
            'https://www.appliancesdelivered.ie/search/small-appliances?sort=price_desc'
        ];

        $data = CrawlerHelper::getProducts($links);

        foreach ($data as $product) {
            $updatedProduct = Product::firstOrNew(['name' => $product['name']]);
            $updatedProduct->img = $product['img'];
            $updatedProduct->url = $product['url'];
            $updatedProduct->price = $product['price'];
            $updatedProduct->save();
        }

        return response()->json('Update succesful');

    }
}
