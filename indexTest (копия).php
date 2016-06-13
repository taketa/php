<?php
// watch -n 5 /usr/bin/php -f ~/Документы/php/1/web/index.php
require "../vendor/autoload.php";
require "../vendor/pear/mail/Mail.php";
$from = '<853211b@gmail.com>';
$to = '<853211b@gmail.com>';
// mail("853211b@gmail.com", "My Subject", "Line 1\nLine 2\nLine 3");
$consumerKey="BokSklDoVGcC9rW7X29D3Ryd7";
$consumerSecret="4hU2oZi3sQasGcr3gz0VkJ8lSwpgCVpvduIBgXHgIkSZu9VbjR";
$accessToken="3135375897-BCHQUl4pUwjCYlojeDn8u3UvTEqJgtLYKpUqgKl";
$accessTokenSecret="FQPYYmkWjHQRu7KSvYCJ8BEOJwfnmEHY8GlyeFfEjxYi3";
// get data
$data = $_GET['data'];
$key='andreysa-test-PRD-44d8cb02c-2804a236';
function getjso($search,$condition,$priceval){
global $from,$to,$consumerKey,$consumerSecret,$accessToken,$accessTokenSecret,$key;
$json = file_get_contents('http://svcs.ebay.com/services/search/FindingService/v1?OPERATION-NAME=findItemsAdvanced&SERVICE-VERSION=1.12.0&SECURITY-APPNAME='.$key.'&RESPONSE-DATA-FORMAT=JSON&REST-PAYLOAD=true&paginationInput.entriesPerPage=5&keywords='.$search.'&itemFilter(0).name=Condition&itemFilter(0).value='.$condition.'&itemFilter(1).name=ListingType&itemFilter(1).value=AuctionWithBIN&sortOrder=StartTimeNewest&categoryId=9355');
$obj = json_decode($json,true);
$main = $obj['findItemsAdvancedResponse'][0]['searchResult'][0]['item'];
$arrMain=[];
foreach (range(0, count($main)-1) as $item) {
	array_push($arrMain,array("id"=>$main[$item]["itemId"][0],'title'=>$main[$item]['title'][0], 'galleryURL'=>$main[$item][
'galleryURL'][0], 'viewItemURL'=>$main[$item]['viewItemURL'][0],'price'=>$main[$item]["listingInfo"][0]["buyItNowPrice"][0]["__value__"],"priceval"=>$priceval));
};
return($arrMain);
};
function addCookie($arr){
	setcookie($arr["id"]);
};

function sendMessage($i){
global $from,$to,$consumerKey,$consumerSecret,$accessToken,$accessTokenSecret,$key,$data;
$file = 'people.txt';
$current = file_get_contents($file);



if (strpos($current, $i["id"])===false){
$current .= $i["id"]."\n";
file_put_contents($file, $current);
if (intval(str_replace("$", "", $i["price"]))<intval($i["priceval"])){
// $body =$i["viewItemURL"];
// $subject = $i["price"]." ".$i["viewItemURL"];
// $headers = array('From' => $from,'To' => $to,'Subject' => $subject);
// $smtp = Mail::factory('smtp', array('host' => 'ssl://smtp.gmail.com','port' => '465',
// 'auth' => true,'username' => '853211b@gmail.com','password' => 'oxnunlcgbjqmaiwx'));
// $mail = $smtp->send($to, $headers, $body);
// if (PEAR::isError($mail)) {
// echo('<p>' . $mail->getMessage() . '</p>');
// } else {
// echo('<p>Message successfully sent!</p>');
// };
$consumerKey="BokSklDoVGcC9rW7X29D3Ryd7";
$consumerSecret="4hU2oZi3sQasGcr3gz0VkJ8lSwpgCVpvduIBgXHgIkSZu9VbjR";
$accessToken="3135375897-BCHQUl4pUwjCYlojeDn8u3UvTEqJgtLYKpUqgKl";
$accessTokenSecret="FQPYYmkWjHQRu7KSvYCJ8BEOJwfnmEHY8GlyeFfEjxYi3";
$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
$twitter->send('@853211b '.$i["price"]." ".$i["viewItemURL"]);
};
};

};



function items($arr){
	foreach ($arr as $item) {
	$items=getjso($item["userInput"],$item["condition"],$item["priceval"]);
	// print_r($items);
	// echo("<br>");
	foreach ($items as $i) {
		sendMessage($i);
		// print_r($i);
	};
};
};
function getdata(){
	global $data;
	$file = 'getdata.txt';
$current = file_get_contents($file);
$current =json_encode($data);
file_put_contents($file, $current);
}
function main(){
getdata();
$file = 'getdata.txt';
$current = file_get_contents($file);
$fin=json_decode($current,true);

items($fin);
sleep(3);
main();
}
main();

?>