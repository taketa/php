<?php 

$data = $_GET['data'];
print_r($data);

echo("<br>");
function addCookie($arr){
	foreach ($arr as $item) {
	setcookie($item);
	echo("ok<br>");
};
};

echo("<br>");
addCookie($data);

echo("<br>");
print_r($_COOKIE);
 ?>