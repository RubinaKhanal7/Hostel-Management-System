<?php 
  require("config.php");
?>

<form action="submit.php" method="post">
	
	<script
		src="https://checkout.stripe.com/checkout.js" class="stripe-button"
		data-key="<?php echo $publishablekey?>"
		data_amount="8000"
		data-name="MCPS"
		data-description="MCPS Desc"
		data-image="img/logo.jpg"
		data-currency="inr"
		>
	</script>
	
</form>
