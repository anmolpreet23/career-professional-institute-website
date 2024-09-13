<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; 
$conn = $pdo->open();
if(isset($_POST['send']))
{
    $name=$_POST['name'];
    $contact=$_POST['contact'];
    $email=$_POST['email'];
    $msg=$_POST['msg'];
    $stmt = $conn->prepare("INSERT INTO contact(`name`,`contact`,`email`,`msg`) VALUES (:fname,:contact,:email,:msg)");
	$stmt->execute(['fname'=>$name,'contact'=>$contact,'email'=>$email,'msg'=>$msg]);
    $_SESSION['success']="Thanks!! We will contact you soon.";
    header('Location:contact.php');
}
?>
<body class="hold-transition skin-blue layout-top-nav" style="margin:0 !important">
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
                                if(isset($_SESSION['success'])){
									echo "
										<div class='alert alert-success'>
											".$_SESSION['success']."
										</div>
									";
									unset($_SESSION['success']);
								}
							?>
                            <div class="col-md-3"></div>
                            <div class="box box-solid col-md-6" style="padding:10px">
                            <h1><center>Need any help ? Contact Us</center></h1><br>
                                <form action="contact.php" method="post">
                                    <div class="form-group">
                                        <input name="name" type="text" class="form-control" placeholder="Your Name">
                                    </div>
                                    <div class="form-group">
                                        <input name="contact" type="text" maxlength="10" class="form-control" placeholder="Whatsapp Contact No.">
                                    </div>
                                    <div class="form-group">
                                        <input name="email" class="form-control" type="email" placeholder="Your Email">
                                    </div>
                                    <div class="form-group">
                                        <textarea rows=5 name="msg" class="form-control" placeholder="Your Query"></textarea>
                                    </div>
                                    <button type="submit" name="send" class="btn btn-primary col-md-1" style="float:right">Send</button>
                                </form>
                            </div>  
                            <div class="col-md-3"></div>
						</div>
					</div>
			    </section>
	        </div>
	    </div>
    </div>
  	<?php include 'includes/footer.php'; ?>
	<?php include 'includes/scripts.php'; ?>
</body>
</html>