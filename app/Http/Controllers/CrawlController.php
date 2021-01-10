<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Illuminate\Support\Str;
use Symfony\Component\CssSelector\CssSelectorConverter;
use Symfony\Component\DomCrawler\Crawler;

class CrawlController extends Controller
{
    //
    public function getAll()
    {
        ini_set('max_execution_time', 5000); // 5 minutes
$videoUrl = "https://r4---sn-i3belney.googlevideo.com/videoplayback?expire=1610238806&ei=9vb5X62HK6WElQTYxobQCA&ip=2401:c440::f816:3eff:fe30:3d4c&id=o-ABIE7h1Gr8U6oPGqgHy4lEPqaJu05xf6NWaRinb95q-6&itag=22&source=youtube&requiressl=yes&hcs=yes&sc=yes&vprv=1&prv=1&mime=video/mp4&ratebypass=yes&dur=7117.287&lmt=1610124152534507&txp=6216222&sparams=expire,ei,ip,id,itag,source,requiressl,vprv,prv,mime,ratebypass,dur,lmt&sig=AOq0QJ8wRAIgb88dHHAgdL6Yfe0zQy5D_5WAODtlvo0uy1eG6ytkKXsCIF_2Myr8XR31f0lPEKwVgzBpLfk7eNXWNVYj2tBb1imI&cms_redirect=yes&mh=Xb&mip=42.119.173.186&mm=32&mn=sn-i3belney&ms=su&mt=1610219348&mv=u&mvi=4&pl=24&shardbypass=yes&lsparams=hcs,mh,mip,mm,mn,ms,mv,mvi,pl,sc,shardbypass&lsig=AG3C_xAwRAIgCynpFiwS9Hz_YFR_s5HqyepjIkHbetZVRtnGug5op8ACIHdGaaoxk4Z5z9yTOZD9SUjrYmkLa6CHzCawNoFQCpuJ";
//        $baseUrl = "https://bilutvzz.net/phim-thuyet-minh//trang-";
//
////        $item = $this->ExactHtmlFromUrl("https://bilutvzz.net/phim-thuyet-minh/" , ".film-k > a");
////        $this->saveImg($item);
//        for($i = 86 ; $i<160 ;$i ++) {
//            echo "round ".($i+1);
//            $item1 = $this->ExactHtmlFromUrl($baseUrl.$i , ".film-k > a");
//            $this->saveImg($item1);
//            echo "Finshed Round ".($i+1);
//        }
//        $this->saveImg($item);
$this->saveVideo($videoUrl);

    }
    private function splitImg($url) {
        return substr($url , 21 , -2);
    }
    private function saveImg($urlArray) {
        if (!file_exists('images')) {
            mkdir('images', 0777, true);
        }

        for($i = 0 ; $i < count($urlArray) ; $i++) {
            $url = $urlArray[$i];
            $img = 'images/anhdat'.Str::random(5).'.jpg';
            file_put_contents($img, file_get_contents($url));
            echo "saved file ".Str::random(5).'.jpg'."<br>";
        }

}

    /**
     * @return array
     */
    private function ExactHtmlFromUrl($url , $selector): array
    {
        $client = new Client();
        $crawler = $client->request('GET', $url);
        $item = $crawler->filter($selector)->each(function (Crawler $node, $i) {
            $ar = $this->splitImg($node->filter(".list-img")->attr("style"));
            return $ar;

        });
        return $item;
    }
    private function saveVideo($url) {
        if (!file_exists('videos/')) {
            mkdir('videos/', 0777, true);
        }

            $img = 'videos/anhdat'.'.mp4';
            file_put_contents($img, file_get_contents($url));
            echo "saved file anhdat".'.mp4'."<br>";


    }


}
