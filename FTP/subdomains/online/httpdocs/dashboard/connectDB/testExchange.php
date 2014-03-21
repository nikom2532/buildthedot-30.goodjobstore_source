<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<!-- dollar exchange -->
<?
function google_finance_convert($from_Currency, $to_Currency, $amount) 
{
	$amount = urlencode($amount);
	$from_Currency = urlencode($from_Currency);
	$to_Currency = urlencode($to_Currency);

	$url = "http://www.google.com/ig/calculator?q=$amount$from_Currency=?$to_Currency";
	$ch = curl_init();
	$timeout = 0;
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$rawdata = curl_exec($ch);
	curl_close($ch);

	$data = explode('"', $rawdata);
	$data = explode(' ', $data[3]);
	$converted = $data[0];
	$converted = str_replace(array("   ", "  ", " "), "sss", $converted);
	//return sprintf("%02.2f", $converted);
	return $converted;
}
function slashit ($string) {
        $string = str_replace ('&#039;', '\'', $string);
        $string = str_replace ('%23', '\"', $string);
        $string = str_replace ('&quot;', '\"', $string);
        $string = str_replace ('&lt;', '<', $string);
        $string = str_replace ('&gt;', '>', $string);
        $string = str_replace ('&amp;', '&', $string);
        $string = str_replace ('&nbsp;', ' ', $string);
        $string = stripslashes($string);
        return rawurlencode($string);
        }
// Usage
echo "<b>THB->USD</b><br>";
$price = google_finance_convert("THB", "USD", "100"); // echos how much 100$ is in Euro
echo "100 ฿ -> $ ".$price;
echo "<br>";
$price = google_finance_convert("THB", "USD", "1000"); // echos how much 100$ is in Euro
echo "1,000 ฿ -> $ ".$price;
echo "<br>";
$price = google_finance_convert("THB", "USD", "10000"); // echos how much 100$ is in Euro
echo "10,000 ฿ -> $ ".$price;
echo "<br>";
$price = google_finance_convert("THB", "USD", "100000"); // echos how much 100$ is in Euro
echo "100,000 ฿ -> $ ".$price;
echo "<br><br>";

echo "<b>USD->THB</b><br>";
$priceTH = google_finance_convert("USD", "THB", "1"); // echos how much 100$ is in Euro
echo "$ 1 -> ".$priceTH." ฿";
echo "<br>";
$priceTH = google_finance_convert("USD", "THB", "10"); // echos how much 100$ is in Euro
$priceTH = str_replace('&nbsp;','',$priceTH);
$string = str_replace ('&nbsp;', ' ', $priceTH);
echo $string;
echo "$ 10 -> ".$priceTH." ฿";
echo "<br><br>";
$priceTH = google_finance_convert("USD", "THB", "200"); // echos how much 100$ is in Euro
//$priceTH = str_replace ("&nbsp;","", $priceTH);
//$priceTH = stripslashes($priceTH);
$priceTH = rawurlencode($priceTH);
$priceTH = str_replace ("%C2%A0",'', $priceTH);
echo "$ 100 -> ".$priceTH." ฿";
echo "<br>";
echo "$ 100 -> ".sprintf("%02.2f", $priceTH)." ฿";
echo "<br>พอใส่ sprintf('%02.2f', $xxx) ไปแล้วมันเลยดึงมาแต่เลข3 เพราะแมร่งเว้นวรรคไรไม่รู้";
?>