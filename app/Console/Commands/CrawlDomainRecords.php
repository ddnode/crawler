<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;
use Carbon\Carbon;
use App\DomainRecord;

class CrawlDomainRecords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:domain-records';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl domain records yesterday';

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
     *
     * @return mixed
     */
    public function handle()
    {
        $yesterday = Carbon::yesterday()->toDateString();
        $page = 1;
        while (true) {
            $html = file_get_contents('http://icp.chinaz.com/provinces?page=' . $page);
            $crawler = new Crawler($html);
            $crawler
                ->filter('#result_table > tr')
                ->each(function (Crawler $node, $i) use ($yesterday) {
                    $domain_record = new DomainRecord;
                    $domain_record->domain = $node->filter('td')->eq(0)->text();
                    $domain_record->company = $node->filter('td')->eq(1)->text();
                    $domain_record->company_type = $node->filter('td')->eq(2)->text();
                    $domain_record->license = $node->filter('td')->eq(3)->text();
                    $domain_record->website = $node->filter('td')->eq(4)->text();
                    $front = $node->filter('td')->eq(5);
                    $fronts = $front->filter('a')->each(function (Crawler $node, $i) {
                        return $node->text();
                    });
                    $domain_record->website_front = implode('<br>', $fronts);
                    $domain_record->time = $node->filter('td')->eq(6)->text();
                    if ($domain_record->time < $yesterday) {
                      die('抓取结束');
                    }
                    if ($domain_record->time == $yesterday) {
                      $domain_record->save();
                    }
                });
            $page++;
        }
    }
}
