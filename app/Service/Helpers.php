<?php

namespace App\Service;



final class Helpers {

    private static $countries = array(
		'ae', 'ar', 'at', 'au', 'be', 'bg', 'br', 'ca', 'ch', 'cn', 'co', 'cu', 'cz', 'de', 'eg', 'fr', 'gb', 'gr',
		'hk', 'hu','id','ie','il','in','it','jp','kr','lt','lv','ma','mx','my','ng','nl','no','nz','ph','pl', 'pt',
		'ro','rs','ru','sa','se','sg','si','sk','th','tr','tw','ua','us','ve','za');

	private static $languages = array('ar','en','cn','de','es','fr','he','it','nl','no','pt','ru','sv','ud');
	private static $categories = array('business', 'entertainment', 'general', 'health', 'science', 'sports', 'technology');



	final static public function __get__($key){
		if($key == 'countries'){ return Helpers::$countries;}
		if($key == 'languages'){ return Helpers::$languages;}
		if($key == 'categories'){ return Helpers::$categories;}
	}

}
