<?php 
require "../vendor/autoload.php";
require "../vendor/pear/mail/Mail.php";
$from = '<853211b@gmail.com>';
$to = '<853211b@gmail.com>';
// mail("853211b@gmail.com", "My Subject", "Line 1\nLine 2\nLine 3");
$consumerKey="BokSklDoVGcC9rW7X29D3Ryd7";
$consumerSecret="4hU2oZi3sQasGcr3gz0VkJ8lSwpgCVpvduIBgXHgIkSZu9VbjR";
$accessToken="3135375897-BCHQUl4pUwjCYlojeDn8u3UvTEqJgtLYKpUqgKl";
$accessTokenSecret="FQPYYmkWjHQRu7KSvYCJ8BEOJwfnmEHY8GlyeFfEjxYi3";
function sendMessage($i){
global $from,$to,$consumerKey,$consumerSecret,$accessToken,$accessTokenSecret,$key,$data;
$file = 'people.txt';
$current = file_get_contents($file);
var_dump($i["id"]);
echo("<br>");
var_dump($current);
echo("<br>");
var_dump((strpos($current, $i["id"])===false));


if (strpos($current, $i["id"])===false){
$current .= $i["id"]."\n";
file_put_contents($file, $current);
if (intval(str_replace("$", "", $i["price"]))<intval($i["priceval"])){
$body =$i["viewItemURL"];
$subject = $i["price"]." ".$i["viewItemURL"];
$headers = array('From' => $from,'To' => $to,'Subject' => $subject);
$smtp = Mail::factory('smtp', array('host' => 'ssl://smtp.gmail.com','port' => '465',
'auth' => true,'username' => '853211b@gmail.com','password' => 'oxnunlcgbjqmaiwx'));
$mail = $smtp->send($to, $headers, $body);
if (PEAR::isError($mail)) {
echo('<p>' . $mail->getMessage() . '</p>');
} else {
echo('<p>Message successfully sent!</p>');
};
};
};
};
 $send=array("id"=>"301980324093","title"=>"iPhone 6 16GB Gold Verizon Water damage (for Parts)","galleryURL"=>"http://thumbs2.ebaystatic.com/m/m6WV7zmsAjYlAF5Jh-P_gCQ/140.jpg","viewItemURL"=>"http://www.ebay.com/itm/iPhone-6-16GB-Gold-Verizon-Water-damage-for-Parts-/301980324093","price"=>"185.0","priceval"=>"500");
sendMessage($send);
 ?>