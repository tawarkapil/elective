<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CustomerMembershipLevel;
use App\Helpers\MailFunctions;
use App\Models\IndustryNews;
use Carbon\Carbon;
use ViewsHelper, CommonHelper;

class FetchOldRSSFeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetchOldRSS:feeds';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command will be fetch all latest feed from all the rss feeds url.';



    public  $urls = [
        /*CHKD*/'https://www.fca.org.uk/news/rss.xml', // Layout1 - channel['item']
        /*CHKD*/'https://www.osfi-bsif.gc.ca/_layouts/15/AtomFeed.aspx?fk=war&lang=en', //Layout2 - entry
        /*CHKD*/'https://www.fintrac-canafe.gc.ca/rss/rss-eng.xml',//Layout2 - entry
        /*CHKD*/'https://news.un.org/feed/subscribe/en/news/topic/law-and-crime-prevention/feed/rss.xml', // Layout1 - channel['item']
        /*CHKD*/'https://www.google.com/alerts/feeds/15424651528328574716/10589287286270352601', //Anti Money Laundering
        /*CHKD*/'https://www.google.com/alerts/feeds/15424651528328574716/6167127722100693820',//Proliferation financing
        /*CHKD*/'https://www.google.com/alerts/feeds/15424651528328574716/5244473703252009881',//Compliance
        /*CHKD*/'https://www.google.com/alerts/feeds/15424651528328574716/16525538236086966127',//"Identity Theft" AND "Fraud"
        //DELETE//SAME - 'https://www.google.com/alerts/feeds/15424651528328574716/16525538236086966127',//"watchlist" AND "sanctions"
        /*CHKD*/'https://www.google.com/alerts/feeds/15424651528328574716/3758653847133141734',//"politically exposed person"
        /*CHKD*/'https://www.google.com/alerts/feeds/15424651528328574716/638552865475798832',//"Watchlist screening"
        /*CHKD*/'https://www.google.com/alerts/feeds/15424651528328574716/15565140640846992907',//"sanctions screening"
        /*CHKD*/'https://www.google.com/alerts/feeds/15424651528328574716/13515753203683072955',//"Financial Crimes"
        /*CHKD*/'https://www.google.com/alerts/feeds/15424651528328574716/12981508173170814036',//"Fraud Prevention"
    ];

    public $wordRestricUrls = [
        'https://www.unodc.org/unodc/en/feed/stories.xml',
        'https://www.unodc.org/unodc/en/feed/press-releases.xml',
    ];

    public $words = [
        'Anti Money Laundering',
        'Proliferation',
        'Bankruptcy',
        'Compliance',
        'Anti Money Laundering',
        'Identity',
        'Theft',
        'Fraud',
        'Bankruptcy',
        'Taxivation',
        'Proliferation',
        'watchlist',
        'sanctions',
        'PEP',
        'politically exposed person',
        'OFAC',
        'Watchlist screening',
        'sanctions screening', 
        'FBI Most Wanted',
        'Anti-Money Laundering',
        'Financial Crimes Institute',
        'Anti-Money Laundering and Financial Crimes Institute',
        'Fraud Prevention',
        'Money Laundering and Financial Crimes Institute'
    ];

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
    public function handle(){
        $normalurls = $this->urls;
        $wordRestricUrls = $this->wordRestricUrls;
        $urls = $normalurls + $wordRestricUrls;
        
        $words = $this->words;
        $words = implode('|', $words);

        $this->runScripts($urls, $words, 2);

        echo "Cron run successfuly at " . date('d-m-Y H:i:s');
    }


   function runScripts($urls, $words, $type = 1){
        $titleArr = [];

        foreach ($urls as $url){
            try{
                $xmlString = file_get_contents($url);
                $xmlObject = simplexml_load_string($xmlString);

                $json = json_encode($xmlObject);
                $xmldata = json_decode($json, true);
                $insertArr = [];
                $obj = new IndustryNews();

                if ((isset($xmldata['channel']) && isset($xmldata['channel']['item'])) || (isset($xmldata['entry'])))
                {
                    // Get value from array
                    $loopArr = (isset($xmldata['entry'])) ? $xmldata['entry'] : $xmldata['channel']['item'];

                    //print_r($loopArr);die;

                    foreach ($loopArr as $key => $row)
                    {

                      //echo "<pre>";print_r($row);die;
                        // get value from xml records...
                        $title = isset($row['title']) ? trim($row['title']) : null;
                        $slug = $obj->getUniqueSlug($title, 0);
                        $link = null;
                        if (isset($row['link']) && !is_array($row['link'])){
                          $link = isset($row['link']) ? trim($row['link']) : null;
                        } else if (isset($row['link']) && is_array($row['link'])){
                          if(isset($row['link']['@attributes']) && isset($row['link']['@attributes']['href'])){
                            $link = isset($row['link']['@attributes']['href']) ? trim($row['link']['@attributes']['href']) : null;
                          }
                        }

                        //Format data before inserting
                        $description = '';
                        if (isset($row['description']) && !is_array($row['description']))
                        {
                            $description = $row['description'];
                        }
                        else if (isset($row['content']) && !is_array($row['content']))
                        {
                            $description = $row['content'];
                        }
                        else if (isset($row['summary']) && !is_array($row['summary']))
                        {
                            $description = $row['summary'];
                        }
                        else if (isset($row['description']) && is_array($row['description']))
                        {
                            $description = trim($title);
                        }




                        $published_date = date('Y-m-d H:i:s');
                        if (isset($row['pubDate']))
                        {
                            $date = explode('.', $row['pubDate']) [0];
                            $date = str_replace(' - ', ' ', $date);
                            $published_date = date('Y-m-d H:i:s', strtotime($date));
                        }
                        else if (isset($row['published']))
                        {
                            $date = explode('.', $row['published']) [0];
                            $date = str_replace(' - ', ' ', $date);
                            $published_date = date('Y-m-d H:i:s', strtotime($row['published']));
                        }
                        else if (isset($row['updated']))
                        {
                            $date = explode('.', $row['updated']) [0];
                            $date = str_replace(' - ', ' ', $date);
                            $published_date = date('Y-m-d H:i:s', strtotime($row['updated']));
                        }
                        else if (isset($row['production_date'])){
                            $date = explode('.', $row['production_date'])[0];
                            $date = str_replace(' - ', ' ', $date);
                            $published_date = date('Y-m-d H:i:s', strtotime($row['production_date']));
                        }

                        if($link){
                          $description .= '... <a href="'.$link.'">Read more</a>';
                        }

                        $checkCondition = false;

                        if(in_array($url, $this->wordRestricUrls) && !str_contains($title, 'job') && (preg_match('(' . $words . ')', $title) === 1 || preg_match('(' . $words . ')', $description) === 1)){
                            $checkCondition = true;                         
                        }

                        if(!in_array($url, $this->wordRestricUrls) && !str_contains($title, 'job')){
                            $checkCondition = true;                         
                        }
                        
                        if ($checkCondition){
                            $readyForRead = false;
                            // if($type == 1 ){
                            $checkOldData = IndustryNews::where('title', $title)->first();
                            if(!$checkOldData){
                              $readyForRead = true;
                            }                    
                            // }else if($type == 2 && (strtotime(date('Y-m-d')) > strtotime(date('Y-m-d', strtotime($published_date))))){
                            //   $checkOldData = IndustryNews::where('title', $title)->first();
                            //   if(!$checkOldData){
                            //     $readyForRead = true;
                            //   }
                            // }

                            if($readyForRead){
                                // Ready value as insert value.
                                $insertArr[$key]['title'] = $title;
                                $insertArr[$key]['slug'] = $slug;
                                $insertArr[$key]['description'] = $description;
                                $insertArr[$key]['published_date'] = $published_date;
                                $insertArr[$key]['created_at'] = $published_date;

                                $insertArr[$key]['created_type'] = 1;
                                $insertArr[$key]['created_by'] = 1;
                                $insertArr[$key]['ref_url'] = $url;
                                $insertArr[$key]['status'] = 1;
                                $insertArr[$key]['is_submitted'] = 1;

                                $titleArr[] = $title;
                            }
                            //echo "<pre>";print_r($insertArr);die;
                        }
                        
                    }

                    $size = 100;
                    $chunks = array_chunk($insertArr, $size);
                    foreach ($chunks as $chunk)
                    {
                        IndustryNews::insert($chunk);
                    }

                }

            }catch(\Exception $e){
                continue;
            }
        }
    }
}
