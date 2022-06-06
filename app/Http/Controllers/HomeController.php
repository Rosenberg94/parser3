<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use voku\helper\HtmlDomParser;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function foo()
    {
        $jobs = Job::all();

        return view('foo', ['jobs' => $jobs]);
    }

    private function getPage($url_num)
    {
        $needle = 'din';
        $pos = strripos($url_num, $needle);
        $substr = substr($url_num, $pos + strlen($needle));
        $delim = '|';
        $res = explode($delim, $substr);

        return $res[0];
    }


    public function sendJs(Request $request)
    {
        $loc = $request->loc;
        $url = $request->url;
        Log::info('foo');

        $searchWord = $url;
        $searchLoc = $loc;

        $url_num = 'https://www.bestjobs.eu/ro/locuri-de-munca-in-'. $searchLoc .'/'. $searchWord .'?scroll=true';

        $file_num = HtmlDomParser::file_get_html($url_num);
        $file_num1 = $file_num->findOne('title');
        $file_num2 = strip_tags($file_num1);
        $file_num3 = $this->getPage($file_num2);

        $page_num = 1;

        Job::truncate();

        do{
            $url = 'https://www.bestjobs.eu/ro/locuri-de-munca-in-'. $searchLoc .'/'.  $searchWord .'/'. $page_num .'?scroll=true';
            $file = HtmlDomParser::file_get_html($url);

            $data = [];

            foreach ($file->findMulti('.job-card') as $div)
            {
                $urlInner = $div->findOne('a.stretched-link')->getAttribute('href');
                $fileInner = HtmlDomParser::file_get_html($urlInner);
                $desc = mb_substr($fileInner->findOne('div.job-description'), 0, 300);

                $data[] = [
                    'title' => strip_tags($div->findOne('span'), '<br>'),
                    'company' => strip_tags($div->findOne('small'), '<br>'),
                    'location' => strip_tags($div->findOne('a.text-truncate')->getAttribute('aria-label'), '<br>'),
                    'description' => strip_tags($desc, '<br>')
                ];
            }
            DB::table('jobs')->insert($data);

        } while ($page_num++<=$file_num3);

        return response()->json([
            'data' => $page_num,
            'jobs' => Job::all(),
        ]);

    }
}
