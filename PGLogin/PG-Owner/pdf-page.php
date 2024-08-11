<?php
include('../pgCheck.php');
?>

<!DOCTYPE html>
<style>
table,
th,
td,
tr {
  border: 1px solid black;
}

td {
  width: 200px;
  height: 165px;
  text-align: center;
}
</style>
<?php
$pdf = "";
$code = $_SESSION['pg'];

$pdf = "<h2 style='display: flex; justify-content: center;
align-items: center;'><img style='margin-right:1rem;' src='./assets/img/PG/sdm_logo.png' width='30' alt='' >Sri Dharmasthala
    Manjunatheshwara PU College Ujire.</h2>                     
        <h2 style='text-align:center;'>Details of the Mess Students</h2>";

include('../../dbmain_conn.php');
$sql1 = "select * from tblmess where code='" . $code . "'";
$res1 = $maincon->query($sql1);
if ($res1->num_rows > 0) {
  while ($row1 = $res1->fetch_assoc()) {
    $messname = $row1['messName'];
    $pdf = $pdf . "<h4>Mess Name: " . $row1['messName'] . "<br><br>
                Owner Name:" . $row1['owner'] . "<br><br>
                Mess Type:" . $row1['messType'] . "<br><br>
                Contact No:" . $row1['contactNo1'] . "<br><br>
                Address:" . $row1['address'] . "</h4>";
  }
}

$pdf = $pdf . "<div id='page-break' style=' page-break-before: always;'>
        <table style='border:1px solid black;' border=1><tr><th>S.No.</th><th>Student Name</th><th>CLass</th><th>Parent's/Gaurdian's Name</th><th>Address</th><th>Contact Number</th><th>Photo</th></tr>";
$sql2 = "select * from tblstudent where messCode='" . $code . "'";
$i = 1;
$res2 = $maincon->query($sql2);
if ($res2->num_rows > 0) {
  while ($row2 = $res2->fetch_assoc()) {
    $pdf = $pdf . "<tr><td>" . $i . "</td>
                <td>" . $row2['name'] . "</td>
                <td>" . $row2['class'] . " " . $row2['combination'] . "</td>
                <td>" . $row2['fatherName'] . "</td>
                <td>" . $row2['address'] . "</td>
                <td>" . $row2['contactNo'] . "</td>
                <td></td></tr>";
    $i = $i + 1;
  }
}
$pdf = $pdf . "</table></div>";


?>

<!-- beautify ignore:start -->
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>PDF</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/Logo/sdm_logo.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

  
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />


    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

  
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

   
    <script src="../assets/vendor/js/helpers.js"></script>


    <script src="../assets/js/config.js"></script>

   

    <link href="assets/css/main.css" rel="stylesheet" />
    <style>
      .btn{
        margin-top: 1%;
      }
      a{
        border-radius: 10px;
        text-decoration: none;
        padding: 10px;
        color: #fff;
       background-color: #0069d9;
       border-color: #0062cc;
      }
    </style>
</head>

<body >
                            <div class="col-xl-12 " style="min-width: 54rem;">
                             <div class="btn">
                                 <a href="index.php">Home</a>
                             </div>
                                <!-- HTML5 Inputs -->
                                <form action="">
                                    <div class="card mb-4" style="margin-top:50px; margin-left:80px">
                                        <div class="card-body">
                                            <div id="printable-content">
                                                <?php echo $pdf; ?>
                                            </div>

                                            <div class="d-flex justify-content-around mt-4" >
                                                <div>
                                                    <button class="btn btn-primary"  onclick="printDiv('printable-content')"value="print" name="print">Print</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <!-- </div> -->
                    <!-- </div> -->
                </div>
                <!-- / Content -->

               

            <!-- <div class="content-backdrop fade"></div> -->
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->

    <script src="../assets/js/form-basic-inputs.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
  <style>
  @media print {
    
    body * {
      visibility: hidden;
    }
    #printable-content, #printable-content * {
      visibility: visible;
    }
    #page-break 
     {
     page-break-before: always;
   }    
    #printable-content {
      position: absolute;
      left: 0;
      top: 0;
    }
    
  }
  
</style>
<script>
  function printDiv(divId) {

    var printContents = document.getElementById(divId).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
  }

  

</script>


</html>