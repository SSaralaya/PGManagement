<?php
include('../pgCheck.php');
include('../../dbmain_conn.php');
if (isset($_POST['insert'])) {
  if (isset($_SESSION['rollno'])) {
    $rno = $_SESSION['rollno'];
    $aadharNo = $_POST['ID'];
    unset($_SESSION['rollno']);
    $aadharimage = $_FILES['imageFile']['tmp_name'];
    $aadharname = $_FILES['imageFile']['name'];
    $extension = pathinfo($aadharname, PATHINFO_EXTENSION);
    $new_name = $rno . '.' . $extension;
    $destination = './aadharUploads/' . $new_name;

    $image = $_FILES['imgFile']['tmp_name'];
    $name = $_FILES['imgFile']['name'];
    $extension = pathinfo($name, PATHINFO_EXTENSION);
    $img_name = $rno . '.' . $extension;
    $imgdestination = './imgUploads/' . $img_name;

    move_uploaded_file($aadharimage, $destination);
    move_uploaded_file($image, $imgdestination);

    $sql3 = "update tblpgstudent set aadharNo='" . $aadharNo . "',aadharImg='" . $new_name . "',image='" . $img_name . "',messCode='" . $_SESSION['pg'] . "' where rollno='" . $rno . "'";
    if ($maincon->query($sql3)) {
      echo "<script>alert('Updated Successully')</script>";
    } else {
      echo "<script>alert('Error in updating...')</script>";
    }
  } else {
    echo "<script>alert('Error')</script>";
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />

  <title>Insert</title>
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
</head>

<body class="page-about">
  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/PG/sdm_logo.png" alt="" />
        <h1 class="d-flex align-items-center">SDM</h1>
      </a>

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="insert.php" class="active">Insert</a></li>
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

  <main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs d-flex align-items-center" style="
          background-image: url('assets/img/PG/upload.jpg');
          background-size: cover;
          background-position: center;
        ">
      <div class="container position-relative d-flex flex-column align-items-center">
        <h2>Insert</h2>
        <ol>
          <li><a href="index.html">Home</a></li>
          <li>Insert</li>
        </ol>
      </div>
    </div>
    <!-- End Breadcrumbs -->
    <div>
      <form method="POST">
        <div class="container d-flex flex-column gap-3 w-50">
          <div class="form-group mt-3">
            <select class="form-control" name="rollno" required>
              <option value="">Select Student Roll no</option>
              <?php
              $sql1 = "select rollno from tblstudent where messCode='" . $_SESSION['pg'] . "' order by rollno ASC";
              $res1 = $maincon->query($sql1);
              if ($res1->num_rows > 0) {
                while ($row1 = $res1->fetch_assoc()) {
                  echo "<option value='" . $row1['rollno'] . "'>" . $row1['rollno'] . "</option>";
                }
              }
              ?>
            </select>
          </div>
          <div class="align-self-center">
            <input class="btn btn-primary" type="submit" name="submit" value="Submit" />
            <input class="btn btn-primary" type="reset" value="Reset" />
          </div>
        </div>
      </form><br>
      <div class="content-wrapper mt-auto">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
          <div class="row d-flex justify-content-center">
            <div class="col-xl-6">

              <?php
              if (isset($_POST['submit'])) {
                $_SESSION['rollno'] = $_POST['rollno'];
                $sql2 = "select name,class,combination,fatherName from tblstudent where rollno='" . $_SESSION['rollno'] . "'";
                $res2 = $maincon->query($sql2);
                if ($res2->num_rows > 0) {
                  while ($row2 = $res2->fetch_assoc()) {
                    $sql4 = "select aadharNo from tblpgstudent where rollno='" . $_SESSION['rollno'] . "'";
                    $res4 = $maincon->query($sql4);
                    if ($res4->num_rows > 0) {
                      while ($row4 = $res4->fetch_assoc()) {
                        $aadharNo1 = $row4['aadharNo'];
                      }
                    } else {
                      $aadharNo1 = "";
                    }
                    echo '<form method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                    <div class="card mb-4">
                      <h5 class="card-header text-center fw-bold">
                        Student Details
                      </h5>
                      <div class="card-body">
                        <div class="mb-3 row">
                          <label
                            for="html5-text-input"
                            class="col-md-4 col-form-label"
                            >Roll No/ Register No</label
                            >
                          <div class="col-md-8">
                            <input
                              class="form-control"
                              type="text"
                              id="html5-text-input" value="' . $_SESSION['rollno'] . '" 
                              readonly
                            />
                          </div>
                        </div>
  
                        <div class="mb-3 row">
                          <label
                            for="html5-text-input"
                            class="col-md-4 col-form-label"
                            >Name</label
                            >
                          <div class="col-md-8">
                            <input
                              placeholder="John"
                              class="form-control"
                              type="text" value="' . $row2['name'] . '"
                              readonly
                            />
                          </div>
                        </div>
  
                        <div class="mb-3 row">
                          <label
                            for="html5-text-input"
                            class="col-md-4 col-form-label"
                            >Class</label
                          >
                          <div class="col-md-8">
                            <input
                              class="form-control"
                              type="text" value="' . $row2['class'] . ' ' . $row2['combination'] . '"
                              readonly
                            />
                          </div>
                        </div>
  
                        <div class="mb-3 row">
                          <label
                            for="html5-tel-input"
                            class="col-md-4 col-form-label"
                            >Father Name</label
                          >
                          <div class="col-md-8">
                            <input
                              class="form-control"
                              type="tel"
                              id="html5-tel-input" value="' . $row2['fatherName'] . '"
                              readonly
                            />
                          </div>
                        </div>
  
                        <div class="mb-3 row">
                          <label
                            for="html5-tel-input"
                            class="col-md-4 col-form-label"
                            >Aadhaar No</label
                          >
                          <div class="col-md-8">
                            <input class="form-control" type="text" name="ID" value="' . $aadharNo1 . '" title="AADHAR number must consists of 12 Numbers" id="ph_no1"  onkeyup="check_no(ID);" minlength="12" maxlength="12" required/>
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label
                            for="html5-date-input"
                            class="col-md-4 col-form-label"
                            >Upload AADHAR Card Copy</label
                          >
                          <div class="col-md-8">
                            <input
                              class="form-control"
                              type="file" 
                             id="formFile" name="imageFile" accept="image/*"
                            required/>
                            <p style="color:red; font-size:10px; ">Maximum file size is 500KB</p>
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label
                            for="html5-date-input"
                            class="col-md-4 col-form-label"
                            >Upload Student Image</label
                          >
                          <div class="col-md-8">
                            <input
                              class="form-control"
                              type="file" 
                             id="formFile" name="imgFile" accept="image/*"
                            required/>
                            <p style="color:red; font-size:10px; ">Maximum file size is 500KB</p>
                          </div>
                        </div>

                        <div class="d-flex justify-content-around mt-4">
                          <div>
                            <input
                              class="btn btn-primary"
                              type="submit" name="insert"
                              value="Submit"
                            />
                          </div>
                          <div>
                            <input
                              class="btn btn-primary"
                              type="reset"
                              value="Reset"
                            />
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>';
                  }
                }
              }
              ?>
              <!-- HTML5 Inputs -->

            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- End #main -->

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
  <script>
    const image = document.getElementById('formFile')
    image.addEventListener('change', (event) => {
      const target = event.target
      if (target.files && target.files[0]) {
        const maxAllowedSize = 500 * 1024

        if (target.files[0].size > maxAllowedSize) {
          target.value = "";
          alert("File Size Exceeded");
        }
      }
    })

    function check_no(ph_no) {
      if (!Number.isFinite(Number(ph_no.value))) {
        ph_no.value = ph_no.value.substr(0, (ph_no.value).length - 1);
      }
    }
  
        function validateForm() {
      const fileInputs = document.querySelectorAll("input[type='file']");

      for (const fileInput of fileInputs) {
        const file = fileInput.files[0];

        if (!file) {
          alert("Please select a file for each image field.");
          return false;
        }

        const allowedTypes = ["image/jpeg", "image/png", "image/jpg"];
        if (!allowedTypes.includes(file.type)) {
          alert("Invalid file type. Please upload only images (JPEG, PNG, GIF).");
          return false;
        }
      }

      return true;
    }
</script>

</body>

</html>