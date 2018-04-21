<?php
/**
 *  Crawler Helper.
 *  Scrape the required data from appliancesdelivered.ie 
 *
 * @author     German Gonzalez Rodriguez <ger@gergonzalez.com>
 * @copyright  German Gonzalez Rodriguez
 *
 * @version    1.0
 */

namespace App\Helpers;

use \Carbon\Carbon;
use Goutte\Client;

class CrawlerHelper
{

    /**
     * Helper private class to filter one product
     *
     * @param Goutte\Client\Crawler $crawler
     * @param Mixed $log Logger 'Class' to output the data as is iterated.
     *
     * @return Array Returns the list of scraped products.
     */
	private static function filter( $crawler, $log ){

		$data = [];

        $crawler->filter('.search-results-product')->each(function ($node) use (&$data, $log) {
            
            $name = $node->filter('.product-description h4')->first()->text();
            $url = $node->filter('.product-image a')->first()->attr('href');
            $image = $node->filter('.product-image img')->first()->attr('src');
            $price = $node->filter('.product-description h3.section-title')->first()->text();

            $floatPrice = floatval(preg_replace('/[^\d\.]/', '', $price));

            if(!is_null($log)){
                $log->info('PRODUCT');
                $log->info($name);
                $log->info($price."\n");
            }

            $product = [
                'name' => trim($name),
                'url' => $url,
                'img' => $image,
                'price' => $floatPrice,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            
            $data[] = $product;

        });

        return $data;
	}


    /**
     * Scrape products from given array of links.
     *
     * @param Array $links 
     * @param Mixed $log Logger 'Class' to output the data as is iterated.
     * @param Int $maxProducts Used as loop guard, the max number of products added. 
     *
     * @return Array Returns the list of scraped products.
     */
	public static function getProducts( $links, $log = null , $maxProducts = 30000)
	{
        $client = new Client();
        $data = [];

        if(!is_null($log)){
            $log->info('------------ CRAWLER STARTS ------------'."\n");
        }

        foreach( $links as $link ){

            $crawler = $client->request('GET', $link);

            $result = self::filter($crawler, $log);

			$data = array_merge($data, $result);

            while ( $maxProducts > 0 ) {
                $link = $crawler->selectLink('next');

                if(!$link->getNode(0)){
                    break;
                }

                $crawler = $client->click( $link->link() );

	            $result = self::filter($crawler, $log);

				$data = array_merge($data, $result);

                --$maxProducts;
            }

		}

        if(!is_null($log)){
            $log->info("\n".'------------ CRAWLER ENDS ------------');
        }

        return $data;

	}

}
