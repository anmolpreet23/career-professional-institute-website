<?php include 'includes/session.php'; ?>
<?php
	$conn = $pdo->open();

	$slug = $_GET['product'];		
	    $stmt = $conn->prepare("SELECT *, products.name AS prodname, category.name AS catname, products.id AS prodid FROM products LEFT JOIN category ON category.id=products.category_id WHERE slug = :slug");
	    $stmt->execute(['slug' => $slug]);
	    $product = $stmt->fetch();
	//page view
	$now = date('Y-m-d');
	if($product['date_view'] == $now){
		$stmt = $conn->prepare("UPDATE products SET counter=counter+1 WHERE id=:id AND status='Active'");
		$stmt->execute(['id'=>$product['prodid']]);
	}
	else{
		$stmt = $conn->prepare("UPDATE products SET counter=1, date_view=:now WHERE id=:id AND status='Active'");
		$stmt->execute(['id'=>$product['prodid'], 'now'=>$now]);
	}

?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-12">
	        		<div class="callout" id="callout" style="display:none">
	        			<button type="button" class="close"><span aria-hidden="true">&times;</span></button>
	        			<span class="message"></span>
	        		</div>
		            <div class="row">
		            	<div class="col-sm-6">
		            		<img src="<?php echo (!empty($product['photo'])) ? 'images/'.$product['photo'] : 'images/noimage.jpg'; ?>" width="100%" class="zoom" data-magnify-src="images/<?php echo $product['photo']; ?>">
		            		<br><br>
							<?php if($product['status']=='Active'){ ?>
		            		<form class="form-inline" id="productForm">
		            			<div class="form-group">
			            			<div class="input-group col-sm-5">
			            				
			            				<span class="input-group-btn">
			            					<button type="button" id="minus" class="btn btn-default btn-flat btn-lg"><i class="fa fa-minus"></i></button>
			            				</span>
							          	<input type="text" name="quantity" id="quantity" class="form-control input-lg" value="1">
							            <span class="input-group-btn">
							                <button type="button" id="add" class="btn btn-default btn-flat btn-lg"><i class="fa fa-plus"></i>
							                </button>
							            </span>
							            <input type="hidden" value="<?php echo $product['prodid']; ?>" name="id">
							        </div>
			            			<button type="submit" class="btn btn-primary btn-lg btn-flat"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
								</div>
		            		</form>
							<?php }else{ ?>
								<label style='color:red;font-size:18px'>Notify me when this product is available</label>
								<input type="hidden" id="pn" value='<?php echo $product['prodname']; ?>'>
								<input type="hidden" id="pi" value="<?php echo $product['prodid']; ?>">
								<input type="email" name="email" class="form-control input-lg" id="email" placeholder="Email">
								<button class="btn btn-primary" type="submit" name="submit" id="send">Notify Me</button>
								<span id="success" style="color:green;font-size:15px;display:none"><b>We will notify you when this product is available.</b></span>
								<span id="error" style="color:red;font-size:15px;display:none"><b>You already subscribed for this product!</b></span>
							<?php } ?>
		            	</div>
		            	<div class="col-sm-6">
		            		<h1 class="page-header"><?php echo $product['prodname']; ?></h1>
		            		<h3><b>&#36; <?php echo number_format($product['price'], 2); ?></b></h3>
		            		<p><b>Category:</b> <a href="category.php?category=<?php echo $product['cat_slug']; ?>"><?php echo $product['catname']; ?></a></p>
		            		<p><b>Description:</b></p>
		            		<p><?php echo $product['description']; ?></p>
		            	</div>
		            </div>
		            <br>
	        	</div>
	        </div>
			<center><b><h1>Similar Products</h1></b></center>
			<?php
				$conn = $pdo->open();
				$catid=$product['category_id'];
				$stmt = $conn->prepare("SELECT * FROM products WHERE category_id = :catid");
				$stmt->execute(['catid' => $catid]);
				echo "<div class='row'>";
				foreach ($stmt as $row) {
					$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
					echo "
							<div class='col-md-3' style='float:left'>
								<div class='box box-solid'>
									<div class='box-body prod-body'>
										<img src='".$image."' width='100%' height='230px' class='thumbnail'>
										<h5><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></h5>
									</div>
									<div class='box-footer'>
										<b>&#36; ".number_format($row['price'], 2)."</b>
									</div>
								</div>
							</div>
						
					";
				}
				echo "</div>";
				$pdo->close();

			?> 
	      </section>
	     
	    </div>
	  </div>
  	<?php $pdo->close(); ?>
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
	$('#add').click(function(e){
		e.preventDefault();
		var quantity = $('#quantity').val();
		quantity++;
		$('#quantity').val(quantity);
	});
	$('#minus').click(function(e){
		e.preventDefault();
		var quantity = $('#quantity').val();
		if(quantity > 1){
			quantity--;
		}
		$('#quantity').val(quantity);
	});

});
</script><!--
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
	$( "#send" ).click(function() {
        $('#success').html('Just Wait...');
		var gmail = $('#email').val();
		var product = $('#pn').val();
		var productid = $('#pi').val();
		$('#error').hide();
		$('#success').hide();
        if (gmail) {
            $.ajax({
                type: 'POST',
                url: 'mail.php',
                data: {
                    'gmail': gmail,
					'product':product,
					'pid':productid
                },
                success: function(result) {
					if(result=='1')
					{
						$('#success').html('<b>We will notify you when this product is available.</b>');
						$('#success').show();
					}
					else if(result=='0')
					{
						$('#error').html('<b>You already subscribed for this product!</b>');
						$('#error').show();
						$('#success').hide();
					}
                },
				error: function(data){
					alert(data);
				}
            });
        } 
    });
</script>-->
</body>
</html>