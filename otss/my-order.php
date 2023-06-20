<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
error_reporting(0);
if (strlen($_SESSION['otssuid']==0)) {
  header('location:logout.php');
  } else{
  	?>
<!DOCTYPE html>
<html>
<head>
<title>Online Tiffin Service System | My Tiffin Order</title>
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
				</div>

<div class="cart-items">
	<div class="container">

			 <h1>My Order</h1>

			 <?php
					        	$uid=$_SESSION['otssuid'];
                  $sql="SELECT DATEDIFF(tblorder.ToDate,tblorder.FromDate) as ddf, tblorder.ID,tblorder.FullName,tblorder.UserID,tblorder.Email,tblorder.MobileNumber,tblorder.Time,tblorder.Address,tblorder.OrderDate,tblorder.FromDate,tblorder.ToDate,tblorder.OrderNumber,tblorder.TotalCost,tblorder.Remark,tblorder.Status,tblorder.Quantity, tblorder.UpdationDate,tbltiffin.Type,tbltiffin.Title,tbltiffin.Description,tbltiffin.Cost,tbltiffin.Image from  tblorder join  tbltiffin on tbltiffin.ID=tblorder.TiffinID where tblorder.UserID=:uid"  ;
$query = $dbh -> prepare($sql);
$query-> bindParam(':uid', $uid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
				<script>$(document).ready(function(c) {
					$('.close1').on('click', function(c){
						$('.cart-header').fadeOut('slow', function(c){
							$('.cart-header').remove();
						});
						});	  
					});
			   </script>
			 <div class="cart-header">
				<!--  <div class="close1"> </div> -->
				 
				 <div class="cart-sec simpleCart_shelfItem">
				 	
						<div class="cart-item cyc">
							 <img src="admin/images/<?php echo $row->Image;?>" class="img-responsive" alt="">
						</div>
					   <div class="cart-item-info">
						<h3><a href="#"> <?php  echo $row->Title;?> </a></h3>
						<span style="font-weight:bold">Order Number:</span>&nbsp; &nbsp;<?php  echo $row->OrderNumber;?>

						<ul class="qty">
							<li><span style="font-weight:bold">Quantity:</span> <?php  echo $qty= $row->Quantity;?></li>
							<li><span style="font-weight:bold">Total Days:</span> <?php  echo $ddf=$row->ddf;?></p></li>
							<li><span style="font-weight:bold">Total Cost:</span> <?php  echo $row->TotalCost;?></p></li>
						</ul>
							 <div class="delivery">
							 <?php	if($row->Status=="" || $row->Status=="Confirmed"){ ?>
							 	<h3><a href="invoice.php?invid=<?php echo $row->OrderNumber;?>" target="_blank"><strong style="color: red">Invoice</strong> </a></h3>
							 <?php } ?>
							 <p style="font-weight:bold">Status:
							 	<?php if($row->Status==""){ 
							 	echo "Not Updated Yet"; ?>
							 <?php } else { ?>
							 	 <?php  echo htmlentities($row->Status); } ?></p> 
							 <span style="font-weight:bold">Total Cost: <?php  echo $row->TotalCost;?></span>
							 <div class="clearfix"></div>
				        </div>	
					   </div>
					   <div class="clearfix"></div>
											
				  </div>
				  <?php $cnt=$cnt+1;}} else {?>	
				  	<h3 style="color:red" align="center">No order placed yet </h3>
				  <?php } ?>
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