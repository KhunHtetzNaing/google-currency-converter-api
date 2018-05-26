<?php
$a = $_GET['a'];
$from = $_GET['from'];
$to = $_GET['to'];
$html = google_currency_conversion($a,$from,$to);
$classname = 'J7UKTe';
$dom = new DOMDocument;
$dom->loadHTML($html);
$xpath = new DOMXPath($dom);
$results = $xpath->query("//*[@class='" . $classname . "']");
if ($results->length > 0) {
$review = $results->item(0)->nodeValue;
$arr = explode("=",$review , 2);

$myObj->input= preg_replace("/[^0-9\.]/", '', $arr[0]);

$mFrom = preg_replace("!\d+!", '', $arr[0]);
$mFrom = str_replace(',', '', $mFrom);
$mFrom = str_replace('.', '', $mFrom);
$mFrom = substr($mFrom,1);
$myObj->from= $mFrom;

$mTo = preg_replace("!\d+!", '', $arr[1]);
$mTo = str_replace(',', '', $mTo);
$mTo = str_replace('.', '', $mTo);
$mTo = substr($mTo,2);
$myObj->to= $mTo;

$myObj->output = preg_replace("/[^0-9\.]/", '', $arr[1]);
$myJSON = json_encode($myObj);
echo $myJSON;
}

function google_currency_conversion($amount, $from_currency, $to_currency){
	$url = 'https://www.google.com/search?q='.$amount.'+' . $from_currency . '+to+' . $to_currency;
	$cSession = curl_init();
	  curl_setopt($cSession, CURLOPT_URL, $url);
	  curl_setopt($cSession, CURLOPT_RETURNTRANSFER, true);	  
	  curl_setopt($cSession, CURLOPT_SSL_VERIFYPEER, false);  
	  $buffer = curl_exec($cSession);
	  curl_close($cSession);
	  return $buffer ;
	}		
?>
