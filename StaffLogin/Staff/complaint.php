<?php
include('../staffCheck.php');
include('../../dbmain_conn.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Complaint</title>
  <link rel="shortcut icon" href="./Img/sdm_logo.png" type="image/x-icon" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Geologica:wght@300&family=Oswald:wght@200&family=Poppins:wght@700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/complaint.css" />
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />

</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top w-100">
    <div class="container-fluid px-3">
      <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="d-flex align-items-center justify-content-between">
        <a class="navbar-brand" href="#"><img src="./Img/sdm_logo.png" style="width: 37px" alt="" /></a>
        <h5>SDM</h5>
      </div>
      <div class="collapse navbar-collapse mx-auto" id="navbarTogglerDemo03">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="inspect.php">Inspections</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="complaint.php">Complaint</a>
          </li>

        </ul>
        <a href="../../logout.php" class="btn btn-danger">Logout</a>
      </div>
    </div>
  </nav>

  <main>
    <!-- Content wrapper -->
    <div class="content-wrapper">
      <!-- Content -->

      <div class="d-flex align-items-center justify-content-center">
        <!-- Search -->
        <form class="d-flex m-4 w-100 align-items-center justify-content-center" method="POST">
          <select class="custom-select w-75" id="inputGroupSelect01" name="mess" required>
            <option value="">Select the pg name</option>
            <?php
            $sql1 = "select * from tblmess";
            $res1 = $maincon->query($sql1);
            if ($res1->num_rows > 0) {
              while ($row1 = $res1->fetch_assoc()) {
                echo "<option value='" . $row1['code'] . " " . $row1['messName'] . "'>" . $row1['code'] . "-" . $row1['messName'] . "</option>";
              }
            }
            ?>
          </select>
          <button class="btn bg-primary text-white " type="submit" style="margin-left: 0.2rem;" name="search">Search</button>
        </form>

        <!-- /Search -->
      </div>
      <div class="container-xxl flex-grow-1 container-p-y d-flex justify-content-center">
        <?php

        if (isset($_POST['search'])) {
          $mess = $_POST['mess'];
          $messCode = explode(" ", $mess);
          $sql3 = "select * from tblcomplaint where  messCode='" . $messCode[0] . "' and status='Unsolved'";
          $res3 = $maincon->query($sql3);
          if ($res3->num_rows > 0) {
            while ($row3 = $res3->fetch_assoc()) {
              $sql4 = "select messName from tblmess where code='" . $messCode[0] . "'";
              $res4 = $maincon->query($sql4);
              $messName = $res4->fetch_column();
              echo "<div class='row d-flex justify-content-center w-100'>
                <div class='col-xl-8 '>
                  <form action='' method='POST'>
                    <div class='card mb-4'>
                      <h5 class='card-header text-center'>PG Name: " . $messName . "</h5>
                      <div class='card-body'>
                        <div class='mb-3 row'>
                          <label for='html5-text-input' class='col-md-4 col-form-label'>Complaint ID</label>
                          <div class='col-md-8'>
                            <input class='form-control' type='text' value='" . $row3['complaintId'] . "' name='cid' readonly />
                          </div>
                        </div>
                        <div class='mb-3 row'>
                          <label for='html5-text-input' class='col-md-4 col-form-label'>Roll No/ Register No</label>
                          <div class='col-md-8'>
                            <input class='form-control' type='text' value='" . $row3['rollno'] . "' name='rollno' readonly />
                          </div>
                        </div>
                        <div class='mb-3 row'>
                          <label for='html5-text-input ' class='col-md-4 col-form-label'>Complaint About:-</label>
                          <div class='col-md-8'>
                            
                            <textarea class='form-control' rows='7' readonly>" . $row3['complaint'] . "</textarea>
                          </div>
                          <div>
                            <input class='btn btn-primary' type='submit' value='Solve' name='solve'>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                </div>";
            }
          } else {

            echo "<div >
            <img class='w-100 no-data' src='../../IMG/no-data.png' alt='No Data Found'>
            </div>";
          }
        }

        if (!isset($_POST['search'])) {

          $sql2 = "select * from tblcomplaint where status='Unsolved'";
          $res2 = $maincon->query($sql2);
          if ($res2->num_rows > 0) {
            while ($row2 = $res2->fetch_assoc()) {
              $sql4 = "select messName from tblmess where code='" . $row2['messCode'] . "'";
              $res4 = $maincon->query($sql4);
              $messName = $res4->fetch_column();
              echo "<div class='row d-flex justify-content-center w-100'>
          <div class='col-xl-8 '>
            <form action='' method='POST'>
              <div class='card mb-4'>
                <h5 class='card-header text-center'>PG Name: " . $messName . "</h5>
                <div class='card-body'>
                  <div class='mb-3 row'>
                    <label for='html5-text-input' class='col-md-4 col-form-label'>Complaint ID</label>
                    <div class='col-md-8'>
                      <input class='form-control' type='text' value='" . $row2['complaintId'] . "' name='cid' readonly />
                    </div>
                  </div>
                  <div class='mb-3 row'>
                    <label for='html5-text-input' class='col-md-4 col-form-label'>Roll No/ Register No</label>
                    <div class='col-md-8'>
                      <input class='form-control' type='text' value='" . $row2['rollno'] . "' name='rollno' readonly />
                    </div>
                  </div>
                  <div class='mb-3 row'>
                    <label for='html5-text-input ' class='col-md-4 col-form-label'>Complaint About:-</label>
                    <div class='col-md-8'>
                      <textarea class='form-control' rows='7' readonly>" . $row2['complaint'] . "</textarea>
                    </div>
                    <div>
                      <input class='btn btn-primary' type='submit' value='Solve' name='solve'>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
          </div>";
            }
          }
        }
        if (isset($_POST['solve'])) {
          $cid = $_POST['cid'];
          $sql5 = "update tblcomplaint set status='Solved' where complaintId=" . $cid;
          if ($maincon->query($sql5)) {
            echo "<script>alert('Complaint Solved')</script>";
          }
        }

        ?>

        <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous">
        </script>
</body>

</html>