<?php
include('../staffCheck.php');

include('../../dbmain_conn.php');
$sql1 = "select * from tblcommittee where emailid='" . $_SESSION['staff'] . "'";
$res1 = $maincon->query($sql1);
if ($res1->num_rows > 0) {
  while ($row1 = $res1->fetch_assoc()) {
    $name = $row1['name'];
    $role = $row1['role'];
  }
}

$sql2="select image from tblcommittee where emailid='".$_SESSION['staff']."'";
$res2=$maincon->query($sql2);
while ($row2 = $res2->fetch_assoc()) {
  $imgname = $row2['image'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home</title>
  <link rel="shortcut icon" href="./Img/sdm_logo.png" type="image/x-icon" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Geologica:wght@300&family=Oswald:wght@200&family=Poppins:wght@700&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="css/styles.css" />
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
    <div class="container-fluid ">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03"
        aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="d-flex align-items-center justify-content-between">
        <a class="navbar-brand" href="#"><img src="./Img/sdm_logo.png" style="width: 37px" alt="" /></a>
        <h5>SDM</h5>
      </div>
      <div class="collapse navbar-collapse mx-auto" id="navbarTogglerDemo03">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="inspect.php">Inspections</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="complaint.php">Complaint</a>
          </li>

        </ul>
        <a href="../../logout.php" class="btn btn-danger">Logout</a>
      </div>
    </div>
  </nav>

  <main>
    <div class="container d-flex justify-content-between align-items-center h-100">
      <div class="cards flex-grow-1 w-100">
        <?php echo '<img src="../../OfficeLogin/cmtUploads/'.$imgname.'" width="350" class="mt-3 mb-2" />'; ?>
        <h1>Hi,<?php echo $name; ?> Sir</h1>
        <h2>SDM PU College Ujire.</h2>
        <h5>
          Role:<?php if ($role = 'Head') {
                  echo "Head of the Paying Guest Committee";
                } else {
                  echo "Paying Guest Committee Member";
                } ?>
        </h5>
        <h5>Email ID:<?php echo $_SESSION['staff']; ?></h5>
        <a class="btn btn-primary" href="inspect.php">Inspections</a>
        <a class="btn btn-outline-primary" c href="complaint.php">Complaint</a>
      </div>
      <div class="img-container">
        <img class="w-100" src="./img/staff.png" alt="" />
      </div>
    </div>
  </main>
  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
    integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous">
  </script>
</body>

</html>