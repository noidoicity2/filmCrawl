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
        ini_set('max_execution_time', 3000); // 5 minutes

        $baseUrl = "https://bilutvzz.net/phim-thuyet-minh//trang-";

//        $item = $this->ExactHtmlFromUrl("https://bilutvzz.net/phim-thuyet-minh/" , ".film-k > a");
//        $this->saveImg($item);
        for($i = 86 ; $i<160 ;$i ++) {
            echo "round ".($i+1);
            $item1 = $this->ExactHtmlFromUrl($baseUrl.$i , ".film-k > a");
            $this->saveImg($item1);
            echo "Finshed Round ".($i+1);
        }
//        $this->saveImg($item);


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

}
