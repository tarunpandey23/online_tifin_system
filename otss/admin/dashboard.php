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
    
    <title>Online Tiffine Service System - Admin Dashboard</title>
    <!-- Custom CSS -->
    <link href="assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    
</head>

<body>
   
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
  
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
       
        <?php include_once('includes/header.php');?>
       
        <?php include_once('includes/sidebar.php');?>
       
        <div class="page-wrapper">
        
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <?php
$aid=$_SESSION['otssaid'];
$sql="SELECT AdminName,Email from  tbladmin where ID=:aid";
$query = $dbh -> prepare($sql);
$query->bindParam(':aid',$aid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Welcome Back <?php  echo $row->AdminName;?>!</h3><?php $cnt=$cnt+1;}} ?>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                   
                </div>
            </div>
        
            <div class="container-fluid">
             
                <div class="card-group">
                 
                        <?php 
                        $sql2 ="SELECT * from  tblorder where Status is null ";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$results2=$query2->fetchAll(PDO::FETCH_OBJ);
$totneworder=$query2->rowCount();
?>   <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium"><?php echo htmlentities($totneworder);?></h2>
                                        
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"><a href="new-order.php">Total New Orders</a></h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="file"></i></span>
                                </div>
                            </div>
                          
                        </div>
                    </div>
                    <div class="card border-right">
                        <div class="card-body"><?php
                             $sql3 ="SELECT * from  tblorder where Status='Confirmed'";
$query3 = $dbh -> prepare($sql3);
$query3->execute();
$results3=$query3->fetchAll(PDO::FETCH_OBJ);
$totconorder=$query3->rowCount();
?>
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>

                                    <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium"><sup
                                            class="set-doller"></sup><?php echo htmlentities($totconorder);?></h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"><a href="confirmed-order.php">Total Confirmed Order</a>
                                    </h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="file"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <?php
                                $sql4 ="SELECT * from  tblorder where Status='Canceled'";
$query4 = $dbh -> prepare($sql4);
$query4->execute();
$results4=$query4->fetchAll(PDO::FETCH_OBJ);
$totcancorder=$query4->rowCount();
?>
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium"><?php echo htmlentities($totcancorder);?></h2>
                                      
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"><a href="cancelled-order.php">Total Cancelled Order</a></h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="file"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                             <?php
                                $sql5 ="SELECT * from  tblorder";
$query5 = $dbh -> prepare($sql5);
$query5->execute();
$results5=$query5->fetchAll(PDO::FETCH_OBJ);
$totallcorder=$query5->rowCount();
?>   
                                <div>
                                    <h2 class="text-dark mb-1 font-weight-medium"><?php echo htmlentities($totallcorder);?></h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"><a href="all-order.php">Total Order</a></h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="file"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               


           <div class="card">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                             <?php
                                $sql6 ="SELECT * from  tbluser";
$query6 = $dbh -> prepare($sql6);
$query6->execute();
$results6=$query6->fetchAll(PDO::FETCH_OBJ);
$totaluser=$query6->rowCount();
?>   
                                <div>
                                    <h2 class="text-dark mb-1 font-weight-medium"><?php echo htmlentities($totaluser);?></h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"><a href="registered-users.php">Total Registered Users</a></h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="users"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>


            </div>
          
          <?php include_once('includes/footer.php');?>
      
        </div>
    
    </div>
    
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="dist/js/app-style-switcher.js"></script>
    <script src="dist/js/feather.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <script src="assets/extra-libs/c3/d3.min.js"></script>
    <script src="assets/extra-libs/c3/c3.min.js"></script>
    <script src="assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
    <script src="dist/js/pages/dashboards/dashboard1.min.js"></script>
</body>

</html>
<?php }  ?>