<?php
include('../pgCheck.php');
include('../../dbmain_conn.php');
$code = $_SESSION['pg'];
if (isset($_POST['upload'])) {
  if (!(file_exists($_FILES['imageFile']['tmp_name'])) || !(is_uploaded_file($_FILES['imageFile']['tmp_name']))) {
    $new_name = "default.jpg";
  } else {
    $image = $_FILES['imageFile']['tmp_name'];
    $name = $_FILES['imageFile']['name'];
    $extension = pathinfo($name, PATHINFO_EXTENSION);
    $new_name = $code . '.' . $extension;
    $destination = '../../OfficeLogin/uploads/' . $new_name;
  }
  if ((file_exists($_FILES['imageFile']['tmp_name'])) || (is_uploaded_file($_FILES['imageFile']['tmp_name']))) {
    move_uploaded_file($image, $destination);
    $sql1 = "update tblmess set pgImage='" . $new_name . "' where code='" . $_SESSION['pg'] . "'";
    if ($maincon->query($sql1)) {
      echo "<script>alert('Uploaded')</script>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />

  <title>Photo Upload</title>
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

<body class="page-portfolio">
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
          <li><a href="insert.php">Insert</a></li>
          <li><a href="delete.php">Delete</a></li>
          <li><a href="photo-upload.php" class="active">Photo Upload</a></li>
          <li><a href="pdf-page.php">PDF Print</a></li>
          <li><a href="../../logout.php">Logout</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <!-- End Header -->

  <main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs d-flex align-items-center" style="
          background-image: url('assets/img/PG/woman-taking-photo-rural-surroundings.jpg');
        ">
      <div class="container position-relative d-flex flex-column align-items-center">
        <h2>Photo Upload</h2>
        <ol>
          <li><a href="index.html">Home</a></li>
          <li>Photo Upload</li>
        </ol>
      </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- ======= Photo Upload Section ======= -->
    <div class="content-wrapper mt-5">
      <!-- Content -->
      <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row d-flex justify-content-center">
          <div class="col-xl-6">
            <!-- HTML5 Inputs -->
            <form action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
              <div class="card mb-4">
                <h5 class="card-header text-center fw-bold">Upload Photo</h5>
                <div class="card-body">
                  <div class="row">
                    <div class="image-preview-container">
                      <div class="preview">
                        <img id="preview-selected-image" />
                      </div>
                      <label for="file-upload">Upload Image</label>
                      <input type="file" id="file-upload" name="imageFile" accept="image/*" onchange="previewImage(event);" />
                    </div>
                  </div>
                  <div class="d-flex justify-content-around mt-4">
                    <div>
                      <input id="btnsub" class="btn btn-success" type="submit" value="Submit" name="upload" />
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Photo Upload Section -->
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
    const previewImage = (event) => {
      const imageFiles = event.target.files;

      const imageFilesLength = imageFiles.length;

      if (imageFilesLength > 0) {
        const imageSrc = URL.createObjectURL(imageFiles[0]);

        const imagePreviewElement = document.querySelector(
          "#preview-selected-image"
        );

        imagePreviewElement.src = imageSrc;
        imagePreviewElement.style.display = "block";
        const btn = document.getElementById("btnsub");
        btn.style.display = "block";
      } else {
        alert('length exceeded');
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