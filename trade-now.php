<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php';
if(isset($_SESSION['user']))
{
	$uid=$_SESSION['user'];
}
else
{
	$uid=$_SESSION['admin'];
} 
if(isset($_POST['submit-shop']))
{
	$shop=$_POST['shop_name'];
	$desc=$_POST['shop_desc'];
	$stmt = $conn->prepare("UPDATE users SET `is_active_shop_request`='1', shop_name=:shop, shop_desc=:desc WHERE id='$uid'");
	$stmt->execute(['shop'=>$shop, 'desc'=>$desc]);
}

$det = $conn->prepare("SELECT * from users WHERE id=:id");
$det->execute(['id'=>$uid]);
$detail = $det->fetch();

?>
<body class="skin-blue layout-top-nav">
	<div class="wrapper">
		<?php include 'includes/navbar.php'; ?>
		<div class="content-wrapper">
			<div class="container">
				<!-- Main content -->
				<section class="content">
				<?php if(isset($_SESSION['user'])){ ?>
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8">
							<?php
								if(isset($_SESSION['error'])){
									echo "
										<div class='alert alert-danger'>
											".$_SESSION['error']."
										</div>
									";
									unset($_SESSION['error']);
								}
							?>
							<h1><center>Lets Start Trading</center></h1>
							<p style="text-align:center;font-size:15px">In order to sell your products, you must be a verified member. This verification process is necessary because of spammers and fraud.</p><br><br>
								<?php if($detail['is_active_shop_request']!=1){ ?>
									<div class="row" style="background:white;padding:10px;border-radius:5px">
									<div class="col-12">
										<form action="trade-now.php" id="form_validate" onkeypress="return event.keyCode != 13;" method="post" accept-charset="utf-8" novalidate="novalidate">
																									
											<div class="form-box m-b-15">
												<div class="text-center">
													<h4 class="title title-start-selling-box">About Your Shop</h4>
												</div>
												<div class="form-box-body">
													<div class="form-group">
														<label class="control-label">Shop Name</label>
														<input type="text" name="shop_name" class="form-control form-input valid" placeholder="Shop Name" maxlength="40" aria-invalid="false">
													</div>
													<div class="form-group">
														<label class="control-label">Shop Description</label>
														<textarea name="shop_desc" class="form-control" placeholder="Describe your Shop"></textarea>
													</div>

												</div>
											</div>

											<div class="form-group m-t-15">
												<div class="custom-control custom-checkbox custom-control-validate-input">
													<input type="checkbox" class="custom-control-input" name="terms_conditions" id="terms_conditions" value="1" required>
													<label for="terms_conditions" class="custom-control-label">I have read and agree to the&nbsp;<a href="terms-conditions.php" class="link-terms" target="_blank"><strong>Terms &amp; Conditions</strong></a></label>
												</div>
											</div>

											<div class="form-group">
												<button type="submit" name="submit-shop" class="btn btn-primary" style="float:right">Submit</button>
											</div>
										</form>
									</div>
								</div>
								<?php }else{ ?>
								<div class="row" style="padding: 10px;border-radius: 5px;background: #e6f9e5;color: green;box-shadow: 0px 0px 10px 0px green;">
									<div class="col-12">
										<b style="color:green;text-align:center">Your Shop Request is under Evaluation .<br>You will able to upload products once admin approve your Shop Opening Request.</b>
									</div>
								</div>
								<?php } ?>
						</div>
						<div class="col-md-2"></div>
					</div>
				</div>
				<?php } ?>
			</section>
	    </div>
	</div>
  	<?php include 'includes/footer.php'; ?>
	<?php include 'includes/scripts.php'; ?>
</body>
</html>