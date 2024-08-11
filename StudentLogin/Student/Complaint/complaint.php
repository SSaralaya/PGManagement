<?php
include('../../studentCheck.php');
$rollno = $_SESSION['student'];
include('../../../dbmain_conn.php');
$sql1 = "select messCode,messName from tblstudent where rollno='" . $rollno . "'";
$res1 = $maincon->query($sql1);
if ($res1->num_rows > 0) {
  while ($row1 = $res1->fetch_assoc()) {
    $_SESSION['messName'] = $row1['messName'];
    $messCode = $row1['messCode'];
  }
}

if (isset($_POST['submit'])) {
  $complaint = $_POST['complaint'];
  $sql2 = "insert into tblcomplaint (rollno,messCode,complaint,status) values('" . $rollno . "','" . $messCode . "','" . $complaint . "','Unsolved')";
  if ($maincon->query($sql2)) {
    echo "<script>alert('Complaint registered Successfully')</script>";
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Complaint</title>
  <link rel="shortcut icon" href="../Img/sdm_logo.png" type="image/x-icon" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Geologica:wght@300&family=Oswald:wght@200&family=Poppins:wght@700&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />

</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03"
        aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="d-flex align-items-center justify-content-center">
        <a class="navbar-brand"><img src="../Img/sdm_logo.png" style="width: 37px" alt="" /></a>
        <h5>SDM</h5>
      </div>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav me-auto mx-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="../index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Leave Letter/Leave_Letter.php">Leave Letter</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="../Complaint/complaint.php">Complaint</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Status/Status.php">Status</a>
          </li>
        </ul>
        <a href="../../../logout.php" class="btn btn-danger">Logout</a>
      </div>
    </div>
  </nav>

  <main>
    <div class="container my-4">
      <form action="" class="d-flex flex-column gap-2" method="POST">
        <input class="form-control" type="text" value="Mess Name: <?php echo $_SESSION['messName']; ?>" name="mess"
          readonly />
        <div class="form-group shadow-textarea">
          <textarea class="form-control z-depth-1" id="exampleFormControlTextarea6" rows="20"
            placeholder="Write The Complaint here..." name="complaint" required></textarea>
        </div>
        <div class="input-group">
          <input type="submit" value="Submit" name="submit" class="btn btn-primary" />
          <input type="reset" value="Reset" class="btn btn-danger mx-1" />
        </div>
      </form>
    </div>
  </main>
  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
    integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous">
  </script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
  <script src="https://kit.fontawesome.com/a6bcfa9fe8.js" crossorigin="anonymous"></script>
</body>

</html>