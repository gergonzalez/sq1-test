<?php
/**
 * Crawler Command.
 * Scrape the required data from appliancesdelivered.ie 
 *
 * @author     German Gonzalez Rodriguez <ger@gergonzalez.com>
 * @copyright  German Gonzalez Rodriguez
 *
 * @version    1.0
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;

use CrawlerHelper;

class crawlerScraper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawler:scrape';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'appliancesdelivered.ie web crawler';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * Uses CrawlerHelper to scrape appliancesdelivered.ie data and returns it.
     *
     * @return mixed
     */
    public function handle()
    {
        $links = [
            'https://www.appliancesdelivered.ie/dishwashers',
            'https://www.appliancesdelivered.ie/search/small-appliances?sort=price_desc'
        ];

        $data = CrawlerHelper::getProducts($links, $this);

        $this->info(var_dump($data));
    }
}
