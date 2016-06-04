#!/usr/bin/php -q
<?php 
require "../vendor/autoload.php";
echo exec('whoami');
$consumerKey="BokSklDoVGcC9rW7X29D3Ryd7";
$consumerSecret="4hU2oZi3sQasGcr3gz0VkJ8lSwpgCVpvduIBgXHgIkSZu9VbjR";
$accessToken="3135375897-BCHQUl4pUwjCYlojeDn8u3UvTEqJgtLYKpUqgKl";
$accessTokenSecret="FQPYYmkWjHQRu7KSvYCJ8BEOJwfnmEHY8GlyeFfEjxYi3";

$key='andreysa-test-PRD-44d8cb02c-2804a236';
$search="iphone%206";
$json = file_get_contents('http://svcs.ebay.com/services/search/FindingService/v1?OPERATION-NAME=findItemsAdvanced&SERVICE-VERSION=1.12.0&SECURITY-APPNAME='.$key.'&RESPONSE-DATA-FORMAT=JSON&REST-PAYLOAD=true&paginationInput.entriesPerPage=5&keywords='.$search.'&itemFilter(0).name=Condition&itemFilter(0).value=3000&itemFilter(1).name=ListingType&itemFilter(1).value=AuctionWithBIN&sortOrder=StartTimeNewest&categoryId=9355');
$obj = json_decode($json,true);
$main = $obj['findItemsAdvancedResponse'][0]['searchResult'][0]['item'];
$arrMain=[];

foreach (range(0, count($main)-1) as $item) {
	array_push($arrMain,array("id"=>$main[$item]["itemId"][0],'title'=>$main[$item]['title'], 'galleryURL'=>$main[$item][
        'galleryURL'], 'viewItemURL'=>$main[$item]['viewItemURL'],'price'=>$main[$item]["listingInfo"][0]["buyItNowPrice"][0]["__value__"]));
    
};
foreach ($arrMain as $i) {
	echo "$i[id]<br>";
};
// отправка cookie
// setcookie('cookie1', $arrMain[0]["id"]);   
// setcookie('cookie2', $arrMain[1]["id"]); 
// setcookie('cookie3', $arrMain[2]["id"]); 
// setcookie('cookie4', $arrMain[3]["id"]); 
// setcookie('cookie5', $arrMain[4]["id"]); 

foreach ($arrMain as $i) {

	if (!array_key_exists($i["id"], $_COOKIE)){
		echo("yes");

		


		setcookie($i["id"]);
		$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
		$twitter->send("@853211b"." ".$i["viewItemURL"][0]." ".$i["price"]);
		
	}
}

// setcookie("three", "cookiethree");
// setcookie("two", "cookietwo");
// setcookie("one", "cookieone");
// print_r(json_encode($_COOKIE));


// после перезагрузки страницы, выведем cookie
// if (isset($_COOKIE['cookie'])) {
//     foreach ($_COOKIE['cookie'] as $name => $value) {
//         $name = htmlspecialchars($name);
//         $value = htmlspecialchars($value);
//         echo "$name : $value <br />\n";
//     }
// }
// echo $_COOKIE["TestCookie"];
// echo $json;
// $consumerKey="BokSklDoVGcC9rW7X29D3Ryd7";
// $consumerSecret="4hU2oZi3sQasGcr3gz0VkJ8lSwpgCVpvduIBgXHgIkSZu9VbjR";
// $accessToken="3135375897-BCHQUl4pUwjCYlojeDn8u3UvTEqJgtLYKpUqgKl";
// $accessTokenSecret="FQPYYmkWjHQRu7KSvYCJ8BEOJwfnmEHY8GlyeFfEjxYi3";
// $twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
// $twitter=>send('I am fine today.');
// $statuses = $twitter=>load(Twitter::ME);
 ?>