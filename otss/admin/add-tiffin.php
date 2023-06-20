<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['otssaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
   $adminid=$_SESSION['otssaid'];
 
  $type=$_POST['type'];
  $title=$_POST['title'];
  $desc=$_POST['desc'];
  $cost=$_POST['cost'];
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
  $sql="insert into tbltiffin(Type,Title,Description,Cost,Image)values(:type,:title,:desc,:cost,:images)";
     $query = $dbh->prepare($sql);
    
     $query->bindParam(':type',$type,PDO::PARAM_STR);
     $query->bindParam(':title',$title,PDO::PARAM_STR);
     $query->bindParam(':desc',$desc,PDO::PARAM_STR);
     $query->bindParam(':cost',$cost,PDO::PARAM_STR);
     $query->bindParam(':images',$images,PDO::PARAM_STR);
$query->execute();

       $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("Tiffin detail has been added.")</script>';
echo "<script>window.location.href ='add-tiffin.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  
}
}

?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
   
    <title>Online Tiffine Service System - Add Tiffin</title>
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
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Add Tiffin</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="text-muted">Home</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Add Tiffin</li>
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
                                <h4 class="card-title">Add Tiffin</h4>
                                <form action="" method="post" enctype="multipart/form-data">
                                    
                                    <div class="form-body">
                                        
                                        <div class="form-group row">
                                            <label class="col-md-2">Type: </label>
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="form-group">
                                                            <select type="text" class="form-control" id="" name="type" value="" required='true'>
                                                                <option value="">Choose Type</option>
                                                                <option value="Veg">Veg</option>
                                                                <option value="Non Veg">Non Veg</option>
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                 
                                                </div>
                                               
                                            </div>
                                        </div>
                                         <div class="form-group row">
                                            <label class="col-md-2">Title: </label>
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="form-group">
                                                          <input type="text" class="form-control" id="" name="title" value="" required='true'>
                                                        </div>
                                                    </div>
                                                 
                                                </div>
                                               
                                            </div>
                                        </div>
                                         <div class="form-group row">
                                            <label class="col-md-2">Description: </label>
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="form-group">
                                                           <textarea type="text" class="form-control" id="" name="desc" value="" required='true'></textarea>
                                                        </div>
                                                    </div>
                                                 
                                                </div>
                                               
                                            </div>
                                        </div>
                                         <div class="form-group row">
                                            <label class="col-md-2">Cost: </label>
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="" name="cost" value="" required='true'>
                                                        </div>
                                                    </div>
                                                 
                                                </div>
                                               
                                            </div>
                                        </div>
                                           <div class="form-group row">
                                            <label class="col-md-2">Image: </label>
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="form-group">
                                                            <input type="file" class="form-control" id="" name="images" value="" required="true">
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