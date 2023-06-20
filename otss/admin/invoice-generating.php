<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['otssaid']==0)) {
  header('location:logout.php');
  } else{



  ?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>

    <title>Online Tiffine Service System - Invoice of Tiffin Order</title>
 
    <link href="assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">

    <link href="dist/css/style.min.css" rel="stylesheet">
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
  
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
         <?php include_once('includes/header.php');?>
       
        <?php include_once('includes/sidebar.php');?>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Invoice of Tiffin Order</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="text-muted">Home</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Invoice of Tiffin Order</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    
                </div>
            </div>
           
            <div class="container-fluid">
              
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Invoice of Tiffin Order</h4>
                             
                                <div class="table-responsive">
                                                       <?php
                  $invid=$_GET['invid'];

$sql="SELECT tblorder.ID,DATEDIFF(tblorder.ToDate,tblorder.FromDate) as ddf,tblorder.FullName,tblorder.Email,tblorder.MobileNumber,tblorder.Time,tblorder.Address,tblorder.OrderDate,tblorder.FromDate,tblorder.ToDate,tblorder.OrderNumber,tblorder.TotalCost,tblorder.Remark,tblorder.Status,tblorder.Quantity, tblorder.UpdationDate,tbltiffin.Type,tbltiffin.Title,tbltiffin.Description,tbltiffin.Cost,tbltiffin.Image from  tblorder join  tbltiffin on tbltiffin.ID=tblorder.TiffinID  where tblorder.ID=:invid";
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
    <td colspan="2"><img src="images/<?php echo $row->Image;?>" width="200" height="150" value="<?php  echo $row->Image;?>"></td>
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
  <input name="Submit2" type="submit" class="txtbox4" value="Print" onClick="return f3();" style="cursor: pointer;"  /></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
            </div>
  
         <?php include_once('includes/footer.php');?>
        </div>
  
    </div>
   
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="dist/js/app-style-switcher.js"></script>
    <script src="dist/js/feather.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <!-- themejs -->
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <!--This page plugins -->
    <script src="assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="dist/js/pages/datatable/datatable-basic.init.js"></script>
</body>

</html>
<?php }  ?>