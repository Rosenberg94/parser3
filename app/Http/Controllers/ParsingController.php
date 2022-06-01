<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use voku\helper\HtmlDomParser;

class ParsingController extends Controller
{
    public function sendUrl(Request $request)
    {
        $s1 = $request->except('_token');
        $searchWord = $s1['url'];
        $searchLoc = $s1['loc'];

        $page_num=1;

        do{
            $url = 'https://www.bestjobs.eu/ro/locuri-de-munca-in-'. $searchLoc .'/'.  $searchWord .'/'. $page_num .'?scroll=true';
            $file = HtmlDomParser::file_get_html($url);

            foreach ($file->findMulti('.job-card') as $div)
            {
                $job = new Job();

                $title1 = strip_tags($div->findOne('span'), '<br>');
                $job->title = $title1;

                $company1 = strip_tags($div->findOne('small'), '<br>');
                $job->company = $company1;

                $loc1 = strip_tags($div->findOne('a.text-truncate')->getAttribute('aria-label'), '<br>');
                $job->location = $loc1;

                $urlInner = $div->findOne('a.stretched-link')->getAttribute('href');
                $fileInner = HtmlDomParser::file_get_html($urlInner);
                $desc = mb_substr($fileInner->findOne('div.job-description'), 0, 200);
                $job->description = strip_tags($desc, '<br>');

                $job->save();
            }

        } while ($page_num++<=1);

        return redirect(route('/'));
    }
}
