<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['otssuid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
    $uid=$_SESSION['otssuid'];
    $AName=$_POST['name'];
  $mobno=$_POST['mobilenumber'];
  $email=$_POST['email'];
  $sql="update tbluser set FullName=:name,MobileNumber=:mobilenumber where ID=:uid";
     $query = $dbh->prepare($sql);
     $query->bindParam(':name',$AName,PDO::PARAM_STR);
     $query->bindParam(':mobilenumber',$mobno,PDO::PARAM_STR);
     $query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();

        echo '<script>alert("Profile has been updated")</script>';
     

  }
  ?>
<!DOCTYPE html>
<html>
<head>
<title>Online Tiffin Service System | Order Page</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- Custom Theme files -->

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfont-->
<link href='//fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Lobster+Two:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--Animation-->
<script src="js/wow.min.js"></script>
<link href="css/animate.css" rel='stylesheet' type='text/css' />
<script>
	new WOW().init();
</script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
				});
			});
		</script>
<script src="js/simpleCart.min.js"> </script>	
</head>
<body>
    <!-- header-section-starts -->
	<div class="header">
		
		<?php include_once('includes/header.php');?>
	<!-- header-section-ends -->
	<div class="contact-section-page">
		<div class="contact-head">
		    <div class="container">
				<h3>My Profile</h3>
				<p>Home/Profile</p>
			</div>
		</div>
		<div class="contact_top">
			 		<div class="container">
			 			<div class="col-md-6 contact_left wow fadeInRight" data-wow-delay="0.4s">
			 				<h4>My Profile</h4>
			 				<p>View Your Profile !!!!!!.</p>
			 				 <?php
$uid=$_SESSION['otssuid'];
$sql="SELECT * from  tbluser where ID=:uid";
$query = $dbh -> prepare($sql);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
							  <form method="post">
								 <div>
<p style="font-size: 20px;color: blue;"><strong>Name:</strong><br /><input type="text" class="form-control" value="<?php  echo $row->FullName;?>" style="font-size: 20px" required="true" name="name"></p>

<p style="font-size: 20px;color: blue;"><strong>Email:</strong><br /><input type="text" class="form-control" value="<?php  echo $row->Email;?>" required="true" name="email" style="font-size: 20px" readonly="true"></p>
<p style="font-size: 20px;color: blue;"><strong>Contact Number:</strong><br /> <input type="text" class="form-control" value="<?php  echo $row->MobileNumber;?>" required="true" name="mobilenumber" style="font-size: 20px" maxlength='10'></p>

<p style="font-size: 20px;color: blue;"><strong>Registration Date:</strong><br /> <input type="text" class="form-control" value="<?php  echo $row->RegDate;?>" style="font-size: 20px" readonly="true"></p>	
		
									
						<?php $cnt=$cnt+1;}} ?>
<div class="clearfix" style="padding-top: 20px"> </div>
									 <div class="sub-button wow swing animated" data-wow-delay= "0.4s">
									 	<p style="color: red" ><input name="submit" style="color: red;font-size: 20px" class="btn btn-success" type="submit" value="Update"></p>
									 </div>
						          </div>
						       </form>
					        </div>
		        <div class="col-md-6 company-right wow fadeInLeft" data-wow-delay="0.4s">
					        <img src="images/image.jpg" width="400" height="400" />
									</div>
			
							
							 </div>
						
						</div>
					</div>

	</div>

	<?php include_once('includes/footer.php');?>
	  <script type="text/javascript">
						$(document).ready(function() {
							/*
							var defaults = {
					  			containerID: 'toTop', // fading element id
								containerHoverID: 'toTopHover', // fading element hover id
								scrollSpeed: 1200,
								easingType: 'linear' 
					 		};
							*/
							
							$().UItoTop({ easingType: 'easeOutQuart' });
							
						});
					</script>
				<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>

</body>
</html><?php }  ?>