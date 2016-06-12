<?php
 /**
 * @package mod_currency_nbu
 * @author Rybalko Igor
 * @version 1.0
 * @copyright (C) 2016 http://wolfweb.com.ua
 * @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
 *
*/
define( '_JEXEC', 1 );

require_once dirname(__FILE__) . '/helper.php';

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
                $rateUSD = RatesNbu::roundRate($v->rate);
                break;
            case 'EUR':
                $rateEUR = RatesNbu::roundRate($v->rate);
                break;
            case 'RUB':
                $rateRUB = RatesNbu::roundRate($v->rate);
                break;
        }
    }

    $result = array(
        'usd'   => $rateUSD,
        'eur'   => $rateEUR,
        'rub'   => $rateRUB,
        'date'  => $date
    );
    if($result) {
        file_put_contents(dirname(__FILE__) . '/data.json', json_encode($result));
    }
}