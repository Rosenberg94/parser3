<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use voku\helper\HtmlDomParser;

class ParsingController extends Controller
{
    public function sendUrl(Request $request)
    {
        $page_num=1;

        do{

            $url = 'https://www.bestjobs.eu/ro/locuri-de-munca-in-bucuresti/symfony/'. $page_num .'?scroll=true';
            $file = HtmlDomParser::file_get_html($url);
            

            foreach ($file->findMulti('.job-card') as $div)
            {

                echo 'Title:'. $div->findOne('span');
                echo '<br>';

                echo 'Company:'. $div->findOne('small');
                echo '<br>';

                echo 'Location:'. $div->findOne('a.text-truncate');
                echo '<br>';

                $urlInner = $div->findOne('a.stretched-link')->getAttribute('href');
                $fileInner = HtmlDomParser::file_get_html($urlInner);
                $desc = $fileInner->findOne('div.job-description');
                echo 'Description:'. $desc ;
                echo '<br>';
                echo '<br>';
                echo '<br>';
                echo '<br>';
            }

        } while ($page_num++<=10);





    }
}
