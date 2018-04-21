<?php
/**
 *  Products Seeder.
 *
 * @author     German Gonzalez Rodriguez <ger@gergonzalez.com>
 * @copyright  German Gonzalez Rodriguez
 *
 * @version    1.0
 */

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $links = [
            'https://www.appliancesdelivered.ie/dishwashers',
            'https://www.appliancesdelivered.ie/search/small-appliances?sort=price_desc'
        ];

        $data = CrawlerHelper::getProducts($links, $this->command);

		DB::table('products')->insert($data);
    }
}
