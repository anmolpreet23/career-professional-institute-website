<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>


<!--  -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-md-12">
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
	        		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		                <ol class="carousel-indicators">
		                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
		                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
		                </ol>
		                <div class="carousel-inner">
		                  <div class="item active">
		                    <img src="images/slide1.jpg" style="height: 280px;width:100%" alt="First slide">
		                  </div>
		                  <div class="item">
		                    <img src="images/slide2.jpg" style="height: 280px;width:100%" alt="Second slide">
		                  </div>
		                  <div class="item">
		                    <img src="images/banner3.png" style="height: 280px;width:100%" alt="Third slide">
		                  </div>
		                </div>
		                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
		                  <span class="fa fa-angle-left"></span>
		                </a>
		                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
		                  <span class="fa fa-angle-right"></span>
		                </a>
		            </div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-9">
		            <h2>MOSTLY SOLD PRODUCTS</h2>
		       		<?php
		       			$month = date('m');
		       			$conn = $pdo->open();
						$inc = 3;	
						$stmt = $conn->prepare("SELECT *, SUM(quantity) AS total_qty FROM details LEFT JOIN sales ON sales.id=details.sales_id LEFT JOIN products ON products.id=details.product_id WHERE MONTH(sales_date) = '$month' AND products.status='Active' GROUP BY details.product_id ORDER BY total_qty DESC LIMIT 6");
						$stmt->execute();
						foreach ($stmt as $row) {
							$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
							$inc = ($inc == 3) ? 1 : $inc + 1;
							if($inc == 1) echo "<div class='row'>";
							echo "
								<div class='col-sm-4'>
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
							if($inc == 3) echo "</div>";
						}
						if($inc == 1) echo "<div class='col-sm-4'></div><div class='col-sm-4'></div></div>"; 
						if($inc == 2) echo "<div class='col-sm-4'></div></div>";
						$pdo->close();

		       		?> 
	        	</div>
	        	<div class="col-md-3" style='margin-top:5.5%'>
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div>
	        </div>
			<center><h2 style="font-family: 'Ultra', sans-serif;margin: 1em 0 0.5em 0;font-size: 36px;text-transform: uppercase;text-shadow: 0 2px white, 0 3px #777;">Our Upcoming Products</h2></center>
			<?php
				$conn = $pdo->open();
				$stmt = $conn->prepare("SELECT * from products WHERE status = 'Upcoming' ORDER BY id DESC LIMIT 8");
				$stmt->execute();
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
			<hr style="border-top: 1px solid #e3dfdf;">
			<center><h2>TODAY'S DEALS</h2></center>
			<?php
				$conn = $pdo->open();
				$stmt = $conn->prepare("SELECT * from products WHERE counter >= '5' ORDER BY id DESC LIMIT 12");
				$stmt->execute();
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
			<center><h2>WHY CHOOSE US?</h2></center><br><br>
			<div class="row unique">
				<div class="col-md-4">
					<div class="card box box-solid" style="height:175px;padding: 15px;">
					<h2>New Standards</h2>
						<div class="left">
							<img src="images/1.png">
						</div>
						<div class="right">
							<span>Thers is only one boss, The Customer.and he can fire anybody in company from down to chairman, simply by spending his money somewhere else.</span>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card box box-solid" style="height:175px;padding: 15px;">
						<h2>High Quality</h2>
						<div class="left">
							<img src="images/2.2.png">
						</div>
						<div class="right">
						<span>When the product is right, you don't have to be a great marketer . All quality standards are maintained.</span> 
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card box box-solid" style="height:175px;padding: 15px;">
					<h2>Certified Products</h2>
						<div class="left">
							<img src="images/3.png">
						</div>
						<div class="right">
						<span>100% Certified Products recommended by top celebrities. Tie Up with world's Leading brand.</span>
						</div>
					</div>
				</div>
			</div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>