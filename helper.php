<?php
 /**
 * @package mod_currency_nbu
 * @author Rybalko Igor
 * @version 1.0
 * @copyright (C) 2016 http://wolfweb.com.ua
 * @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
 *
*/

defined('_JEXEC') or die('Restricted access');

class RatesNbu{

	static public function getCurrencyArray(){
   		return json_decode(file_get_contents(__DIR__.'/data.json'), true);
	}

	static public function roundRate($rate){
	    $result = ceil( (float) $rate * 100) / 100;
	     return $result;
	}
}