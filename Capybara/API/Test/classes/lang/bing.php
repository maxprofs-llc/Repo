<?php

	class lang_bing {
		
		private static $apiKey='6701FEF1D586FC10A6414890CF39E08C17055524';
		
		private static function loadData($url, $ref = false) {
			helper::debugPrint("Url:". $url,"translate");
			$chImg = curl_init($url);
			curl_setopt($chImg, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($chImg, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:2.0) Gecko/20100101 Firefox/4.0");
			if ($ref) {
				curl_setopt($chImg, CURLOPT_REFERER, $ref);
			}
			$curl_scraped_data = curl_exec($chImg);
			curl_close($chImg);
			return $curl_scraped_data;
		}
		 
		static function translate($text, $from = 'en', $to = 'sv') {
			$data = self::loadData('http://api.bing.net/json.aspx?AppId=' . self::$apiKey . '&Sources=Translation&Version=2.2&Translation.SourceLanguage=' . $from . '&Translation.TargetLanguage=' . $to . '&Query=' . urlencode($text));
			$translated = json_decode($data);
			if (sizeof($translated) > 0) {
				if (isset($translated->SearchResponse->Translation->Results[0]->TranslatedTerm)) {
					return $translated->SearchResponse->Translation->Results[0]->TranslatedTerm;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}	
	}
?>