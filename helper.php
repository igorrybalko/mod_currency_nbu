<?php
 /**
 * @package mod_currency_nbu
 * @author Rybalko Igor
 * @version 1.1
 * @copyright (C) 2017 http://wolfweb.com.ua
 * @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
 *
*/
defined('_JEXEC') or die('Restricted access');

class ModCurrencyNbuHelper{

	public function getRates(){

		$cache = JFactory::getCache('modCurrencyNBU', '');
		$cache->setCaching(true);
		$cache->setLifeTime(360);
		$rates = $cache->get('rates');

		if(!$rates) {
			$rates = $this->_getNBURate();
			$cache->store($rates, 'rates');
		}

		return $rates;
	}

	private function _roundRate($rate){
	    $result = sprintf("%.2f", ceil( (float) $rate * 100) / 100);
	     return $result;
	}

	private function _getNBURate(){
		$date  = date('d.m.Y');
		$curl_handle = curl_init();
		curl_setopt($curl_handle, CURLOPT_URL,'http://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?json');
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
		$currency = json_decode(curl_exec($curl_handle));
		curl_close($curl_handle);

		if (is_array($currency)) {
			foreach($currency as $v){
				switch ($v->cc){
					case 'USD':
						$rateUSD = $this->_roundRate($v->rate);
						break;
					case 'EUR':
						$rateEUR = $this->_roundRate($v->rate);
						break;
					case 'RUB':
						$rateRUB = $this->_roundRate($v->rate);
						break;
				}
			}

			$rates = array(
				'usd'   => $rateUSD,
				'eur'   => $rateEUR,
				'rub'   => $rateRUB,
				'date'  => $date
			);

			return $rates;
		}
	}
}