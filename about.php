<?php
session_start();
include('./dbmain_conn.php');
$code = $_GET['id'];
$sql1 = "select * from tblmess where code='" . $code . "'";
$res1 = $maincon->query($sql1);
if ($res1->num_rows > 0) {
  while ($row1 = $res1->fetch_assoc()) {
    $messName = $row1['messName'];
    $owner = $row1['owner'];
    $address = $row1['address'];
    $contact1 = $row1['contactNo1'];
    $contact2 = $row1['contactNo2'];
    $contact3 = $row1['contactNo3'];
    $messType = $row1['messType'];
    $foodType = $row1['foodType'];
    $deposit = $row1['deposit'];
    $rent = $row1['monthRent'];
    $distance = $row1['distance'];
    $strength = $row1['strength'];
    $vacancy = $row1['vacancy'];
    $image = $row1['pgImage'];
  }
} else {
  header('Location: ./allPg.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>About</title>
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
    .cards {
      flex-wrap: wrap;
      width: 50%;
      height: 50%;
    }
  }

  .navbar .navbar-brand img {
    max-height: 43px;
  }
  </style>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
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
        <a href="index.php" class="nav-item nav-link">Home</a>
        <a href="allPg.php" class="nav-item nav-link">All PG</a>

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
  <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
      <h1 class="display-4 text-light animated slideInDown mb-4">About Us</h1>
    </div>
  </div>
  <!-- Page Header End -->

  <!-- About Start -->
  <div class="container-xxl py-5">
    <div class="container">
      <div class="row g-5">
        <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
          <div class="position-relative overflow-hidden rounded ps-10 pt-5 h-100" style="min-height: 400px">
            <img class="position-absolute w-100 h-100" <?php echo "src='./OfficeLogin/uploads/" . $image . "'"; ?>
              alt="Image" style="object-fit: fill;" />
            <!-- <div
                class="position-absolute top-0 start-0 bg-white rounded pe-3 pb-3"
                style="width: 200px; height: 200px"
              >
                <div
                  class="d-flex flex-column justify-content-center text-center bg-primary rounded h-100 p-3"
                >
                  <h1 class="text-white mb-0">25</h1>
                  <h2 class="text-white">Years</h2>
                  <h5 class="text-white mb-0">Experience</h5>
                </div>
              </div> -->
          </div>
        </div>
        <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
          <div class="h-100">
            <h1 class="display-6 mb-5">
              <?php echo $messName; ?>
            </h1>
            <p class="fs-5 text-primary mb-4">
              <?php echo $messName;  ?> is located at <?php echo $address; ?> . The distance from college to
              <?php echo $messName;  ?> is <?php echo $distance; ?>.
            </p>


            <div class="row g-4 mb-4">
              <?php if ($messType === "Boys") : ?>
              <div class="col-sm-6">
                <div class="d-flex align-items-center">
                  <img class="flex-shrink-0 me-3" src="img/boys.jpg" alt="" />
                  <h5 class="mb-0">Boys PG</h5>
                </div>
              </div>
              <?php endif; ?>
              <?php if ($messType === "Girls") : ?>
              <div class="col-sm-6">
                <div class="d-flex align-items-center">
                  <img class="flex-shrink-0 me-3" src="img/girls.jpg" alt="" />
                  <h5 class="mb-0">Girls PG</h5>
                </div>
              </div>
              <?php endif; ?>

              <?php if ($foodType === "Veg") : ?>
              <div class="col-sm-6">
                <div class="d-flex align-items-center">
                  <img class="flex-shrink-0 me-3" src="img/veg.jpg" alt="" />
                  <h5 class="mb-0">Veg Food</h5>
                </div>
              </div>
              <?php endif; ?>

              <?php if ($foodType === "Non-Veg") : ?>
              <div class="col-sm-6">
                <div class="d-flex align-items-center">
                  <img class="flex-shrink-0 me-3" src="img/nonveg.png" alt="" />
                  <h5 class="mb-0">Non-Veg Food</h5>
                </div>
              </div>
              <?php endif; ?>
            </div>

            <div class="row g-5">
              <div class="col-sm-6">
                <h1 class="display-5"><?php echo "₹" . $deposit; ?></h1>
                <p class="fs-5 text-primary">Annual Deposit</p>
              </div>
              <div class="col-sm-6">
                <h1 class="display-5"><?php echo "₹" . $rent; ?></h1>
                <p class="fs-5 text-primary">Monthly Rent</p>
              </div>
              <div class="col-sm-6">
                <h1 class="display-5" data-toggle="counter-up"><?php echo $strength; ?></h1>
                <p class="fs-5 text-primary">Total Strength</p>
              </div>
              <div class="col-sm-6">
                <h1 class="display-5" data-toggle="counter-up "><?php echo $vacancy; ?></h1>
                <p class="fs-5 text-primary">Vacancy</p>
              </div>
            </div>

            <p class="mb-4">

            </p>
            <div class="border-top mt-4 pt-4">
              <div class="d-flex align-items-center">
                <img class="flex-shrink-0 rounded-circle me-3" src="img/contact.png" alt="" />
                <h5 class="mb-0">Call Us: <?php echo $contact1; ?></h5>
              </div>
              <?php if ($contact2 != "") {
                echo " <div class='d-flex align-items-center'>
                  <img
                    class='flex-shrink-0 rounded-circle me-3'
                    src='img/contact.png'
                    alt=''
                  />
                  <h5 class='mb-0'>Call Us: " . $contact2 . "</h5>
                </div>";
              }
              ?>
              <?php if ($contact3 != "") {
                echo " <div class='d-flex align-items-center'>
                  <img
                    class='flex-shrink-0 rounded-circle me-3'
                    src='img/contact.png'
                    alt=''
                  />
                  <h5 class='mb-0'>Call Us: " . $contact3 . "</h5>
                </div>";
              }
              ?>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- About End -->
  <div class="container mb-5 ">
    <h3 class="text-center wow fadeInUp" data-wow-delay="0.5s">Review</h3>
    <div class=" w-100 d-flex justify-content-center mt-3">
      <div class="card wow fadeInUp" data-wow-delay="0.5s" style="width: 27rem;">
        <div class="card-body ">
          <!-- Review -->
          <?php
          $sql2 = "select food,hotWater,cleaniliness,powerBackup,ccCamera from tblinspection where messCode='" . $code . "'";
          $res2 = $maincon->query($sql2);
          if ($res2->num_rows > 0) {
            while ($row2 = $res2->fetch_assoc()) {
              $food = $row2['food'];
              $hotwater = $row2['hotWater'];
              $clean = $row2['cleaniliness'];
              $power = $row2['powerBackup'];
              $ccCamera = $row2['ccCamera'];
              $review1 = ['Food', 'Hot water Facility', 'Cleanliness', 'Power Backup Facility', 'CC Camera Facility'];
              $review2 = [$food, $hotwater, $clean, $power, $ccCamera];
              $i = 0;
              foreach ($review1 as $review) {
                echo "<script>alert(" . $review2[$i] . ")</script>";
                echo "<h5 class='wow fadeInUp' data-wow-delay='0.5s'>" . $review . ":-";
                switch ($review2[$i]) {
                  case "Good":
                    for ($x = 0; $x < 5; $x++) {
                      echo "
                    <span
                      id='boot-icon'
                      class='bi bi-star-fill'
                      style='font-size: 1.5rem; color: rgb(255, 210, 48)'
                    ></span> ";
                    };
                    echo "</h5>";
                    break;
                  case "Average":
                    for ($x = 0; $x < 4; $x++) {
                      echo "
                    <span
                      id='boot-icon'
                      class='bi bi-star-fill'
                      style='font-size: 1.5rem; color: rgb(255, 210, 48)'
                    ></span> ";
                    };
                    echo "</h5>";
                    break;
                  case "Bad":
                    for ($x = 0; $x < 3; $x++) {
                      echo "
                    <span
                      id='boot-icon'
                      class='bi bi-star-fill'
                      style='font-size: 1.5rem; color: rgb(255, 210, 48)'
                    ></span> ";
                    };
                    break;
                  default:
                    echo "No Review Found</h5>";
                }
                $i = $i + 1;
              }
            }
          }

          ?>
        </div>
      </div>
    </div>
  </div>


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

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</body>

</html>