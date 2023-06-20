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
   
    <title>Online Tiffine Service System - B/W Dates Report</title>
    <link href="dist/css/style.min.css" rel="stylesheet">
   </head>

<body>
  
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
   
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
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">B/W Dates Report</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="text-muted">Home</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">B/W Dates Report</li>
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
                                <form method="post" name="bwdatesreport" action="order-bwdates-reports-details.php">
                                    
                                    <div class="form-body">
                                        
                                      
                                         <div class="form-group row">
                                            <label class="col-md-2">From Date: </label>
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="form-group">
                                                           <input type="date" class="form-control" id="fromdate" name="fromdate" value="" required='true'>
                                                        </div>
                                                    </div>
                                                 
                                                </div>
                                               
                                            </div>
                                        </div>
                                       
                                         <div class="form-group row">
                                            <label class="col-md-2">To Date:</label>
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="form-group">
                                                            <input type="date" class="form-control" id="todate" name="todate" value="" required='true'>
                                                        </div>
                                                    </div>
                                                 
                                                </div>
                                               
                                            </div>
                                        </div>
                                        </div>
                                  
                                    <div class="form-actions">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-info" name="submit">Submit</button>
                                           </div>
                                    </div>
                                </form>
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
</body>

</html>
<?php }  ?>