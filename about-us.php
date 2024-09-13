<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
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
							<h1><center>About Us</center></h1><br>
							
							<h2><b>Who We Are</b></h2>
							<p>Quad Commerce creating opportunities for these individuals throughout its network, empowering them with financial independence, and helping them realize their true potential. We Strive to achieve the highest level of "Customer Satisfaction" possible. We have always taken pride in our culture. There are some core values that have been inherent and are integral part of our success story. These values are a pure reflection of what is important to us a Team and Business. We do not give up. We make it happen - no matter what it takes or how long.</p> 

							<p>We take complete ownership and accountability not just for the process but for results and outcomes, as well. Very decision we take should be in the interest of the organization. The situation and our responses may very but our determination to act with integrity must remain constant.</p>

							<p>Everybody matters st Quad Commerce - both internal & external stakeholders. Every interaction, in person or virtual, is an opportunity to show respect. Curiosity helps us identity the needs and concerns of our customers, suppliers and employees. Questions help us understand and resolve every situation - sometimes before it becomes one.</p>
							
							<h2><b>What We Do</b></h2>
							<p>Quad Commerce Empowers small and medium-sized business to reach millions of customers with a number of programmes that help boost their revenue, reach and productivity. By telling stories from a wide range of perspectives, We tell the larger story of who Quad Commerce is and how Quad Commerce's core business practices contribute to a better World. We brings you hundreds of millions of products in over 40 different major categories, including consumer electronics, machinery and apparel. Buyers for these products are located in 190+ countries and regions, and exchange hundreds of thousands of messages with suppliers on the platform each day. As a platform, we continue to develop services to help businesses do more and discover new opportunities. Whether it's sourcing from your mobile phone or contacting suppliers in their local language, turn to Quad Commerce for all your globalbusiness needs.</p>
							  

							<h2><b>Working at Quad Commerce</b></h2>
							<p>We employ extraordinary people who do meaningful work that has a tangible impact on the lives of individuals all over the world. And we aspire to make extraordinary things possible for each other, for our customers, and for you. If you're an inventor, you love to build and be part of high performance teams who are passionate about operational excellence. You'll love it here. From day one at Quad Commerce, you'll take ownership of projects that have a direct impact on customers. You'll love being an Quad Commerce Employee.</p>

							
						</div>
					</div>
					<h1><center><b><u>Our Team</u></b></center></h1><br>
					<div class="row profile">
						<div class="col-lg-1" style="width: 13%;"></div>
						<div class="col-lg-3">
							<div class="our-team">
								<div class="picture">
									<img src="images/abhishek.jpg">
								</div>
								<div class="team-content">
									<h3 class="name">Abhishek Malik</h3>
									<h4 class="title">Founder cum Web Developer</h4>
								</div>
								<ul class="social">
									<li><a href="https://www.facebook.com/profile.php?id=100059475066638" class="fa fa-facebook" target="_blank"></a></li>
									<li><a href="https://www.instagram.com/new_king.am/" target="_blank" class="fa fa-instagram"></a></li>
									
								</ul>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="our-team">
								<div class="picture">
									<img src="images/shubham.jpg">
								</div>
								<div class="team-content">
									<h3 class="name">Shubham Chopra</h3>
									<h4 class="title">Web Designer</h4>
								</div>
								<ul class="social">
									<li><a href="https://www.facebook.com/profile.php?id=100007424506028" class="fa fa-facebook" target="_blank" ></a></li>
									<li><a href="https://www.instagram.com/itz_shubham_chopra/" target="_blank" class="fa fa-instagram" ></a></li>
									
								</ul>
							</div>
						</div>

						<div class="col-lg-3">
							<div class="our-team">
								<div class="picture">
									<img src="images/gurmeet.jpg">
								</div>
								<div class="team-content">
									<h3 class="name">Gurmeet Singh</h3>
									<h4 class="title">Game Developer</h4>
								</div>
								<ul class="social">
									<li><a href="https://www.facebook.com/profile.php?id=100007061178606" class="fa fa-facebook" target="_blank" ></a></li>
									<li><a href="https://www.instagram.com/itz._.singh/" target="_blank" class="fa fa-instagram" ></a></li>
									
								</ul>
							</div>
						</div>
						
						<div class="col-lg-1"></div>
					</div>
					<div class="row profile">
						<div class="col-lg-3"></div>
						<div class="col-lg-3">
							<div class="our-team">
								<div class="picture">
									<img  src="images/varun.jpg">
								</div>
								<div class="team-content">
									<h3 class="name">Varun</h3>
									<h4 class="title">Tester</h4>
								</div>
								<ul class="social">
									<li><a href="https://www.facebook.com/kashyapvarun710" class="fa fa-facebook" target="_blank" ></a></li>
									<li><a href="https://www.instagram.com/varun_prajapati_10/" target="_blank" class="fa fa-instagram" ></a></li>
									
								</ul>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="our-team">
								<div class="picture">
									<img src="images/honey.jpg">
								</div>
								<div class="team-content">
									<h3 class="name">Honey Kumar</h3>
									<h4 class="title">Partner</h4>
								</div>
								<ul class="social">
									<li><a href="https://www.facebook.com/honeykumar" class="fa fa-facebook" target="_blank" ></a></li>
									<li><a href="https://www.instagram.com/honeykumar/" target="_blank" class="fa fa-instagram" ></a></li>
									
								</ul>
							</div>
						</div>
						<div class="col-lg-3"></div>
					</div>
				</div>
			</section>
	    </div>
	</div>
  	<?php include 'includes/footer.php'; ?>
	<?php include 'includes/scripts.php'; ?>
</body>
</html>