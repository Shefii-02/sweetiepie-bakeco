<?php
$message = 'Hi Biju Yohannan, Thank you for submitting the form request';
$headers .= 'From: <cesario@mysweetiepie.ca>' . "\r\n";
$headers .= 'Reply-To: <cesario@mysweetiepie.ca>' . "\r\n";


mail("bijuys@gmail.com","My subject",$msg);

echo "Email successfully sent";