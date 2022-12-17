<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use App\Service\NewsApi;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use ApiResponser;
    // getPosts
    public function getPosts(Request $request)
    {

        $newsapi = new NewsApi();

        if(!is_null($request->search)){
            $q = $request->search;
        }else{
            $q = 'Apple';
        }

        $from = $request->from;
        $to = $request->to;
        $language = $request->to;
        $page = $request->page;

        $posts =$newsapi->getEverything($q, $from, $to, $language,$page);

        return $this->success([
            'items' => $posts,
        ],'Items lists',200);
    }

    // getCountries
    public function getCountries(){
        $newsapi = new NewsApi();

        $counties = $newsapi->getCountries();
        return $this->success([
            'items' => $counties,
        ],'Items lists',200);
    }



    // getCategories
    public function getCategories(){
        $newsapi = new NewsApi();

        $categories = $newsapi->getCategories();

        return $this->success([
            'items' => $categories,
        ],'Items lists',200);
    }

    // getLanguages
    public function getLanguages(){
        $newsapi = new NewsApi();

        $items = $newsapi->getLanguages();

        return $this->success([
            'items' => $items,
        ],'Items lists',200);
    }




}
