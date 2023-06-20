<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['otssuid']==0)) {
  header('location:logout.php');
  } else{
    
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
<script language="javascript" type="text/javascript">
function f2()
{
window.close();
}
function f3()
{
window.print(); 
}
</script>
</head>
<body>
    <!-- header-section-starts -->
	<div class="header">
		
		<?php include_once('includes/header.php');?>
	<!-- header-section-ends -->
	<div class="contact-section-page">
		<div class="contact-head">
		    <div class="container">
				<h3>Invoice</h3>
				<p>Home/Invoice</p>
			</div>
		</div>
		<div class="contact_top">
			 		<div class="container">
			 			<div class="col-md-12">
			 				<h4>My Invoice</h4>
			 				<p>View Your Invoice !!!!!!.</p>
			 				<?php
                  $invid=$_GET['invid'];

$sql="SELECT tblorder.ID,DATEDIFF(tblorder.ToDate,tblorder.FromDate) as ddf,tblorder.FullName,tblorder.Email,tblorder.MobileNumber,tblorder.Time,tblorder.Address,tblorder.OrderDate,tblorder.FromDate,tblorder.ToDate,tblorder.OrderNumber,tblorder.TotalCost,tblorder.Remark,tblorder.Status,tblorder.Quantity, tblorder.UpdationDate,tbltiffin.Type,tbltiffin.Title,tbltiffin.Description,tbltiffin.Cost,tbltiffin.Image from  tblorder join  tbltiffin on tbltiffin.ID=tblorder.TiffinID  where tblorder.OrderNumber=:invid";
$query = $dbh -> prepare($sql);
$query-> bindParam(':invid', $invid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
							  <table border="1" class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                                            <tr>
    <th colspan="5" style="text-align: center;color: red;font-size: 20px">Order Number: <?php  echo $row->OrderNumber;?></th>
  </tr>
  

  <tr>
    <th>Name of Customer</th>
    <td><?php  echo $row->FullName;?></td>
   <th>Mobile Number</th>
    <td colspan="2"><?php  echo $row->MobileNumber;?></td>
  </tr>
  <tr>
    <th>Email</th>
    <td><?php  echo $row->Email;?></td>
    <th>Order Date</th>
    <td colspan="2"><?php  echo $row->OrderDate;?></td>
  </tr>
   <tr>
    <th>Tiffin Title</th>
    <td><?php  echo $row->Title;?></td>
    <th>Tiffin Image</th>
    <td colspan="2"><img src="admin/images/<?php echo $row->Image;?>" width="200" height="150" value="<?php  echo $row->Image;?>"></td>
  </tr>
 <tr>
    <th>Tiffin Cost</th>
    <td><?php  echo $row->Cost;?></td>
    <th>Tiffin Quantity</th>
    <td colspan="2"><?php  echo $row->Quantity;?></td>
  </tr>

 <tr>
    <th>From Date</th>
    <td><?php  echo $row->FromDate;?></td>
    <th>To Date</th>
    <td colspan="2"><?php  echo $row->ToDate;?></td>
  </tr>

<table border="1" class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
  <tr>
    <th colspan="5" style="text-align: center;color: red;font-size: 20px">Invoice Detail</th>
  </tr>
  <tr>
    <th style="text-align: center;">Total Days</th>
   <th style="text-align: center;">Total Quantity</th>
   <th style="text-align: center;">Tiffin Cost</th>
   <th style="text-align: center;">Total Cost</th>
  </tr>
<tr>
  <td style="text-align: center;"><?php  echo $ddf=$row->ddf;?></td>
  <td style="text-align: center;"><?php  echo $qty= $row->Quantity;?></td>
  <td style="text-align: center;"><?php  echo $tp= $row->Cost;?></td>
<td style="text-align: center;"><?php  echo $total= $ddf*$tp*$qty;?></td>

  </tr>
  
  <?php 
$grandtotal+=$total;
$cnt=$cnt+1;} ?>
<tr>
  <th colspan="2" style="text-align:center;color: blue">Grand Total </th>
<td colspan="2" style="text-align: center;"><?php  echo $grandtotal;?></td>
</tr>
 
<?php $cnt=$cnt+1;} ?>
</table>
</table> 
<p style="text-align: center;font-size: 20px">
  <input name="Submit2" type="submit" class="btn btn-success" style="color: red;font-size: 20px" value="Print" onClick="return f3();" style="cursor: pointer;"  /></p>

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