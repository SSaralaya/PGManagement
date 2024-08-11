<?php
include('../pgCheck.php');
include('../../dbmain_conn.php');

$sql1 = "select * from tblmess where code='" . $_SESSION['pg'] . "'";
$res1 = $maincon->query($sql1);
if ($res1->num_rows > 0) {
  while ($row1 = $res1->fetch_assoc()) {
    $mName = $row1['messName'];
    $owner = $row1['owner'];
    $address = $row1['address'];
    $email = $row1['emailid'];
    $cNo1 = $row1['contactNo1'];
    $cNo2 = $row1['contactNo2'];
    $cNo3 = $row1['contactNo3'];
    $mType = $row1['messType'];
    $fType = $row1['foodType'];
    $deposit = $row1['deposit'];
    $mRent = $row1['monthRent'];
    $distance = $row1['distance'];
    $strength = $row1['strength'];
    $vacancy = $row1['vacancy'];
  }
} else {
  // header('Location: ../../logout.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />

  <title>PG Owner</title>
  <meta content="" name="description" />
  <meta content="" name="keywords" />

  <!-- Favicons -->
  <link href="assets/img/PG/sdm_logo.png" rel="icon" />
  <link href="assets/img/PG/sdm_logo.png" rel="apple-touch-icon" />

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
  <link href="assets/vendor/aos/aos.css" rel="stylesheet" />
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet" />

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>

<body class="page-index">
  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/PG/sdm_logo.png" alt="" />
        <h1 class="d-flex align-items-center">SDM</h1>
      </a>

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.php" class="active">Home</a></li>
          <li><a href="insert.php">Insert</a></li>
          <li><a href="delete.php">Delete</a></li>
          <li><a href="photo-upload.php">Photo Upload</a></li>
          <li><a href="pdf-page.php">PDF Print</a></li>
          <li><a href="../../logout.php">Logout</a></li>
        </ul>
      </nav>
      <!-- .navbar -->
    </div>
  </header>
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">
    <div class="container">
      <div class="row">
        <div class="col-xl-4">
          <h2 data-aos="fade-up"><?php echo $mName; ?></h2>
          <blockquote data-aos="fade-up" data-aos-delay="100">
            <p>
              <strong>Address :-</strong><?php echo $address; ?>
            </p>
          </blockquote>
          <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
            <a href="insert.php" class="btn btn-get-started">Upload</a>
            <a href="delete.php" class="btn-watch-video d-flex align-items-center">
              <i class="bx bx-trash-alt bx-tada" style="color: #ebe0e0"></i><span>Delete</span></a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Hero Section -->

  <main id="main">
    <!-- ======= Recent Blog Posts Section ======= -->
    <section id="recent-posts" class="recent-posts">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>Accepted Leave Requests</h2>
        </div>

        <div class="row gy-5">

          <?php
          $sql2 = "select * from tblleave where messCode='" . $_SESSION['pg'] . "' and status='Approved'";
          $res2 = $maincon->query($sql2);
          if ($res2->num_rows > 0) {
            echo "<table class='table table-bordered'>
                <thead>
                  <tr>
                    <th scope='col'>S.I No.</th>
                    <th scope='col'>Regiter Number</th>
                    <th scope='col'>From</th>
                    <th scope='col'>To</th>
                    <th scope='col'>Reason</th>
                    <th scope='col'>Status</th>
                  </tr>
                </thead>
                <tbody>";
            $i = 1;
            while ($row2 = $res2->fetch_assoc()) {
              echo " <tr>
                   <th scope='row'>" . $i . "</th>
                   <td>" . $row2['rollno'] . "</td>
                   <td>" . $row2['fromDt'] . "</td>
                   <td>" . $row2['toDt'] . "</td>
                   <td>" . $row2['reason'] . "</td>
                   <td>" . $row2['status'] . "</td>
                 </tr>";
              $i = $i + 1;
            }
            echo " </tbody>
                 </table>";
          } else {
            echo "<center><h3>No Accepted Leaves Found<h3><center>";
          }
          ?>
          <br>
          <hr>
        </div>
      </div>
    </section>
    <!-- End Recent Blog Posts Section -->
  </main>
  <!-- End #main -->
  <main id="main">
    <!-- ======= Recent Blog Posts Section ======= -->
    <section id="recent-posts" class="recent-posts">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>Student Info</h2>
        </div>

        <div class="row gy-5">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">S.I No.</th>
                <th scope="col">Regiter Number</th>
                <th scope="col">Student Name</th>
                <th scope="col">Class</th>
                <th scope="col">Father Name</th>
                <th scope="col">Contact</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql2 = "select * from tblstudent where messCode='" . $_SESSION['pg'] . "'";
              $res2 = $maincon->query($sql2);
              if ($res2->num_rows > 0) {
                $i = 1;
                while ($row2 = $res2->fetch_assoc()) {
                  echo " <tr>
                   <th scope='row'>" . $i . "</th>
                   <td>" . $row2['rollno'] . "</td>
                   <td>" . $row2['name'] . "</td>
                   <td>" . $row2['class'] . " " . $row2['combination'] . "</td>
                   <td>" . $row2['fatherName'] . "</td>
                   <td>" . $row2['contactNo'] . "</td>
                 </tr>";
                  $i = $i + 1;
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>
    <!-- End Recent Blog Posts Section -->
  </main>


  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="footer-legal">
      <div class="container">
        <div class="copyright">
          &copy; Copyright <strong><span>SDM</span></strong>. All Rights Reserved
        </div>
        <div class="credits">Designed by <a href="#">3rd BCA</a></div>
      </div>
    </div>
  </footer>
  <!-- End Footer -->
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</body>

</html>