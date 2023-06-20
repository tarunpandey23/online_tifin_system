<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['otssaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
   
 $eid=$_GET['editid'];
  $images=$_FILES["images"]["name"];
  $extension = substr($images,strlen($images)-4,strlen($images));
$allowed_extensions = array(".jpg","jpeg",".png",".gif",".pdf");
if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('Food Image has Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
}
else
{
$images=md5($images).time().$extension;
 move_uploaded_file($_FILES["images"]["tmp_name"],"images/".$images);
  $sql="update tbltiffin set Image=:images where ID=:eid";
     $query = $dbh->prepare($sql);
     $query->bindParam(':images',$images,PDO::PARAM_STR);
     $query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();

echo '<script>alert("Food Image has been updated")</script>';
  
}}
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
   
    <title>Online Tiffine Service System - Update Food Image</title>
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
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Update Food Image</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="text-muted">Home</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Update Food Image</li>
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
                                <h4 class="card-title">Update Food Image</h4>
                                <form action="" method="post" enctype="multipart/form-data">
                                <?php
                   $eid=$_GET['editid'];
$sql="SELECT * from tbltiffin where ID=$eid";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>    
                                    <div class="form-body">
                                     
                                         <div class="form-group row">
                                            <label class="col-md-2">Title: </label>
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="form-group">
                                                          <input type="text" class="form-control" id="" name="title" value="<?php  echo htmlentities($row->Title);?>" readonly='true'>
                                                        </div>
                                                    </div>
                                                 
                                                </div>
                                               
                                            </div>
                                        </div>
                                     <div class="form-group row">
                                            <label class="col-md-2">Old Image: </label>
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="form-group">
                                                            <img src="images/<?php echo $row->Image;?>" width="200" height="150" value="<?php  echo $row->Image;?>">
                                                        </div>
                                                    </div>
                                                 
                                                </div>
                                               
                                            </div>
                                        </div>
                                           <div class="form-group row">
                                            <label class="col-md-2">New Image: </label>
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="form-group">
                                                            <input type="file" class="form-control" id="" name="images" value="" required='true'>
                                                        </div>
                                                    </div>
                                                 
                                                </div>
                                               
                                            </div>
                                        </div>
                                    </div>
                                  <?php $cnt=$cnt+1;}} ?>
                                    <div class="form-actions">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-info" name="submit">Update</button>
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