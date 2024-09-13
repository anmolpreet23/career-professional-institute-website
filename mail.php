<?php
include 'includes/conn.php';

if(isset($_POST['product']))
{
	/* Insert mail in database for product */
$chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
srand((double)microtime()*1000000); 
$i = 0; 
$pass = '' ; 

while ($i <= 7) { 
	$num = rand() % 33; 
	$tmp = substr($chars, $num, 1); 
	$pass = $pass . $tmp; 
	$i++; 
} 

$conn = $pdo->open();
$to_email = $_POST['gmail'];
$pid = $_POST['pid'];
$product = $_POST['product'];
$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM `notify` WHERE `user_email`=:email");
$stmt->execute(['email'=>$to_email]);
$row = $stmt->fetch();

if($row['numrows'] > 0)
{
	echo '0';
}
else
{
	$to_email = $_POST['gmail'];
	$subject = "Product Subscription from QuadCommerce";
	$body = "<h1>Welcome to Quad Commerce.</h1>\nHi $to_email,\n\n Thanks for subscribing for $product .You will receive notification whenever this product available on website. Don't worry We also hate overflodding inboxes as much as you do. If you want to unsubscribe at any time you can with our any email sent by us to you.\n\n Thanks";
	$headers = "From: quadcommercestores@gmail.com";
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$mail=mail($to_email, $subject, $body, $headers);

		$stmt = $conn->prepare("INSERT INTO `notify`(`product_id`,`user_email`) VALUES (:pid,:email)");
		$stmt->execute(['pid'=>$pid,'email'=>$email]);
		echo '1';
}

$pdo->close();
}
else{

/* Insert mail in database for newsletter */
$chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
srand((double)microtime()*1000000); 
$i = 0; 
$pass = '' ; 

while ($i <= 7) { 
	$num = rand() % 33; 
	$tmp = substr($chars, $num, 1); 
	$pass = $pass . $tmp; 
	$i++; 
} 

$conn = $pdo->open();
$to_email = $_POST['gmail'];
$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM `subscribers` WHERE email=:email");
$stmt->execute(['email'=>$to_email]);
$row = $stmt->fetch();

if($row['numrows'] > 0)
{
	echo '0';
}
else
{
	$to_email = $_POST['gmail'];
	$subject = "Newsletter Subscription from QuadCommerce";
	$body = "<h1>Welcome to Quad Commerce.</h1>\nHi $to_email,\n\n Thanks for subscribing our newsletter .You will receive notifications whenever a new product uploaded on website. Don't worry We also hate overflodding inboxes as much as you do. If you want to unsubscribe at any time you can with our any email sent by us to you.\n\n Thanks";
	$headers = "From: quadcommercestores@gmail.com";
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$mail=mail($to_email, $subject, $body, $headers);

	if($mail)
	{
		$stmt = $conn->prepare("INSERT INTO subscribers(email,code) VALUES (:email,:code)");
		$stmt->execute(['email'=>$to_email,'code'=>$pass]);
		echo '1';
	}
}

$pdo->close();
}
?>