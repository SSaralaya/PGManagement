<?php
include('./dbmain_conn.php');
if (isset($_POST['submit'])) {
  $ftype = $_POST['ftype'];
  $mtype = $_POST['mtype'];
  $sql2 = "select * from tblmess where ";
  if ($mtype === "1") {
    $sql2 = $sql2 . " (messType='Boys' and";
  } elseif ($mtype === "2") {
    $sql2 = $sql2 . " (messType='Girls' and";
  }
  if ($ftype === "1") {
    $sql2 = $sql2 . " foodType='Veg')";
  } elseif ($ftype === "2") {
    $sql2 = $sql2 . " foodType='Non-Veg')";
  } elseif ($ftype === "3") {
    $sql2 = $sql2 . " foodType='Veg')";
    if ($mtype === "1") {
      $sql2 = $sql2 . " or (messType='Boys' and foodType='Non-Veg')";
    } elseif ($mtype === "2") {
      $sql2 = $sql2 . " or (messType='Girls' and foodType='Non-Veg')";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>All Pg</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="" name="keywords" />
  <meta content="" name="description" />

  <!-- Favicon -->
  <link href="img/sdm_logo.png" rel="icon" />

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Poppins:wght@600;700&display=swap"
    rel="stylesheet" />

  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />

  <!-- Libraries Stylesheet -->
  <link href="lib/animate/animate.min.css" rel="stylesheet" />
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />

  <!-- Customized Bootstrap Stylesheet -->
  <link href="css/bootstrap.min.css" rel="stylesheet" />

  <!-- Template Stylesheet -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- Boxicons CSS -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <style>
  @media (max-width:40em) {
    .select-options {
      flex-wrap: wrap;

    }
  }

  .navbar .navbar-brand img {
    max-height: 43px;
  }

  .card-info:hover {
    transform: translate3d(0, -10px, 0);
  }
  </style>
</head>

<body>
  <!-- Spinner Start -->
  <div id="spinner"
    class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-grow text-primary" role="status"></div>
  </div>
  <!-- Spinner End -->



  <!-- Navbar Start -->
  <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5">
    <a href="index.php" class="navbar-brand d-flex align-items-center">
      <h4 class="m-0">
        <img class="img-fluid me-3" src="img/sdm_logo.png" alt="" />SDM
      </h4>
    </a>
    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <div class="navbar-nav mx-auto bg-light rounded pe-4 py-3 py-lg-0">
        <a href="index.php" class="nav-item nav-link ">Home</a>
        <a href="allPg.php" class="nav-item nav-link active">All PG</a>

        <a href="committee.php" class="nav-item nav-link">Contact Us</a>
        <div class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Login</a>
          <div class="dropdown-menu bg-light border-0 m-0">
            <a href="./OfficeLogin/index.php" class="dropdown-item">Office Login</a>
            <a href="./StaffLogin/index.php" class="dropdown-item">Committee Members Login</a>
            <a href="./PGLogin/index.php" class="dropdown-item">PG Owner Login</a>
            <a href="./StudentLogin/index.php" class="dropdown-item">Student Login</a>
          </div>
        </div>
      </div>
    </div>

  </nav>
  <!-- Navbar End -->

  <!-- Page Header Start -->
  <div class="container-fluid page-header py-5 mb-2 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
      <h1 class="display-4 text-light animated slideInDown mb-4">All Pg</h1>
    </div>
  </div>
  <!-- Page Header End -->

  <!-- Service Start -->
  <div class="container-xxl py-2">
    <div class="container">
      <section class="gallery">
        <div class="container">
          <form action="" method="POST">
            <h4 class="font-weight-bold mb-2 text-center ">Filters</h4>
            <div class="select-options d-flex gap-2 mb-5 ">
              <select class="form-select w-100 wow fadeInUp" data-wow-delay="1.10s" aria-label="Default select example"
                name="ftype" required>
                <option value="">Food Type</option>
                <option value="1">Veg</option>
                <option value="2">Non-veg</option>
                <option value="3">Veg/Non-Veg</option>
              </select>
              <select class="form-select w-100 wow fadeInUp" data-wow-delay="1s" aria-label="Default select example"
                name="mtype" required>
                <option value="">PG Type</option>
                <option value="1">Boy's</option>
                <option value="2">Girl's</option>
              </select>
              <input class="btn btn-primary wow fadeInUp" data-wow-delay="0.5s" type="submit" value="Submit"
                name="submit">
              <a class="btn btn-primary px-3 w-25 wow fadeInUp" data-wow-delay="0.5s" href="allPg.php">All</a>
            </div>
          </form>
          <div class="row">
            <!-- gallery item start -->
            <!-- Change -->
            <?php
            if (!isset($_POST['submit'])) {
              $sql1 = "select * from tblmess order by vacancy DESC ";
              $res1 = $maincon->query($sql1);
              if ($res1->num_rows > 0) {

                while ($row1 = $res1->fetch_assoc()) {
                  echo "
                  <div class='card-info col-lg-3 col-md-6 wow fadeInUp mb-4' data-wow-delay='0.1s' >
                  <div class='card' >
                  <img class='card-img-top' src='./OfficeLogin/uploads/" . $row1['pgImage'] . "'style='.image-resize{height:100px;}  
                  max-height: 225px;
            min-height: 224px' alt='error image'>
                  <div class='card-body'>
                    <h5 class='card-title'>" . $row1['messName'] . "</h5>
                    <p class='card-text'>Paying Guest Accommodations For " . $row1['messType'] . ".</p>
                    <hr>
                    <div class='d-flex justify-content-between align-items-center'>
                      <div>
                      <p class='card-text mb-1' >Rent starts at</p>
                      <h5> &#8377; " . $row1['monthRent'] . "</h5>
                      </div>
                      <div>
                      <a href='about.php?id=" . $row1['code'] . "' class='btn btn-primary' >More Info</a>
                      </div>
                    </div>
                  </div>
                </div>
                </div>";
                }
              }
            } else {
              $res2 = $maincon->query($sql2);
              if ($res2->num_rows > 0) {
                echo "<div class='row row-cols-1 row-cols-md-3 wow fadeInUp' data-wow-delay='0.1s'>";
                while ($row2 = $res2->fetch_assoc()) {
                  echo "
                  <div class='card-info col-lg-3 col-md-6 wow fadeInUp ' data-wow-delay='0.1s' >
                  <div class='card' >
                  <img class='card-img-top' src='./OfficeLogin/uploads/" . $row2['pgImage'] . "'style='.image-resize{height:100px;}' alt='error image'>
                  <div class='card-body'>
                    <h5 class='card-title'>" . $row2['messName'] . "</h5>
                    <p class='card-text'>Paying Guest Accommodations For " . $row2['messType'] . ".</p>
                    <hr>
                    <div class='d-flex justify-content-between align-items-center'>
                      <div>
                      <p class='card-text mb-1' >Rent starts at</p>
                      <h5> &#8377; " . $row2['monthRent'] . "</h5>
                      </div>
                      <div>
                      <a href='about.php?id=" . $row2['code'] . "' class='btn btn-primary' >More Info</a>
                      </div>
                    </div>
                  </div>
                </div>
                </div>";
                }
                echo "</div>";
              }
            }


            ?>
            <!--End Change -->
            <!-- gallery item end -->
          </div>
        </div>
      </section>
    </div>
  </div>
  <!-- Service End -->

  <!-- Footer Start -->
  <div class="container-fluid bg-dark footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
      <div class="row g-5">
        <div class="col-lg-3 col-md-6">
          <h3 class="text-white mb-4">
            <img class="img-fluid me-3 w-25" src="img/sdm_logo.png" alt="" />SDM
          </h3>

          <div class="d-flex pt-2">
            <a class="btn btn-square me-1" href=""><i class="fab fa-twitter"></i></a>
            <a class="btn btn-square me-1" href=""><i class="fab fa-facebook-f"></i></a>
            <a class="btn btn-square me-1" href="https://www.youtube.com/channel/UCxz5OxAt3qt9r73rZPPFYEw"><i
                class="fab fa-youtube"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <h5 class="text-light mb-4">Address</h5>
          <p>
            <i class="fa fa-map-marker-alt me-3"></i>Sri Dharmasthala Manjunatheshwara P. U. College
            Ujire – 574 240, D.K., Karnataka, India
          </p>



        </div>
        <div class="col-lg-3 col-md-6">
          <h5 class="text-light mb-4">Quick Links</h5>
          <!-- <a class="btn btn-link" href="">About Us</a> -->
          <a class="btn btn-link" href="index.php">Home</a>
          <a class="btn btn-link" href="allPg.php">All PG</a>
          <a class="btn btn-link" href="committee.php">Contact Us</a>

        </div>

        <div class="col-lg-3 col-md-6">
          <h5 class="text-light mb-4">Contact Details:</Details>
          </h5>
          <p><i class="fa fa-phone-alt me-3"></i>08256 – 236221 / 237321</p>
          <p><i class="fa fa-envelope me-3"></i>sdmpuc@sdmcujire.in</p>
          <p><i class="bx bx-window fa-browser me-3"></i><a href="https://sdmpucujire.in/">https://sdmpucujire.in/</a>
          </p>
        </div>

      </div>
    </div>
    <div class="container-fluid copyright">
      <div class="container">
        <div class="row">
          <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
            &copy; <a href="https://sdmpucujire.in/">SDM PUC | Ujire</a>, All Right Reserved.
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- Footer End -->

  <!-- Back to Top -->
  <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/waypoints/waypoints.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/counterup/counterup.min.js"></script>

  <!-- Template Javascript -->
  <script src="js/main.js"></script>
  <script src="Fjs/script.js"></script>
</body>

</html>