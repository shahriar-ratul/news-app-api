<?php
namespace App\Service;

use Exception;
use GuzzleHttp\Client;

class NewsApi
{
	private $auth, $request_header;

	public function __construct()
	{
        $api_key = env('API_kEY') ?? '5fbe90e9be104dc9917ea326937b212b';

		$this->auth = new NewsApiAuth($api_key);
		$this->request_header = $this->auth->AuthHeaders();
		$this->client = new Client(['timeout'  => 30]);
	}

    public function getEverything($q=null, $from=null,$to=null,$language=null,$page=1){
		//Search through millions of articles from small and big blogs.

        $api_key = env('API_kEY') ?? '5fbe90e9be104dc9917ea326937b212b';
		$payload = array();

		//Add Search keyword if provided
		if (!is_null($q)) { $payload['q'] = $q; }

		//Add From if provided
		if(!is_null($from))
		{
			if(strlen($from) < 10){ throw new NewsApiException('from argument must be YYYY-MM-DD format');}
			else{ $payload['from']=$from; }
		}

		//Add To if provided
		if(!is_null($to))
		{
			if(strlen($to) < 10){ throw new NewsApiException('to argument must be YYYY-MM-DD format');}
			else{ $payload['to']=$to; }
		}
        $payload['pageSize']= 10;

        $payload['page']= $page;



		//Make Request
		$url = "https://newsapi.org/v2/everything";
		try{
			$response = $this->client->request('GET', $url, ['headers'=>$this->request_header, 'query'=>$payload]);
			if($response->getStatusCode() == 200){
				return json_decode($response->getBody()->__toString());
			}
			else{
				$response_body = json_encode($response->getBody());

				throw new NewsApiException($response_body->message);
			}
		}
		catch (Exception $e)
		{
			throw new NewsApiException($e->getMessage());
		}

	}


	public function getCountries(){ return Helpers::__get__('countries'); }
	public function getCategories(){ return Helpers::__get__('categories'); }
	public function getLanguages(){ return Helpers::__get__('languages'); }
}
