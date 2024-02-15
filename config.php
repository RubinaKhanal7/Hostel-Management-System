<?php
$conn=mysqli_connect('localhost','root','','project');
	
require('stripe-php/init.php'); 

$publishablekey="pk_test_51NLdmkCDjcSSFzTOdmlci2FwR5pku89TiF4VxHVULQpqcbHodmGMzlFLclFKrVTLz89ae3H27faD8SbJnTJXi2Hr00sfdppdfR";

$secretkey="sk_test_51NLdmkCDjcSSFzTOQvd8vUhEYALUhyrrd2yp0xxp8bbKt9oy0iiywttnbZDfXt3Xxo56XMj2pGeAWYhuaHtMscNk00SEqSWjU8";

\Stripe\Stripe::setApikey($secretkey);
?>