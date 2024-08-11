<?php
include('../staffCheck.php');
include('../../dbmain_conn.php');
$res3 = $maincon->query("select name as staffname from tblcommittee where emailid='" . $_SESSION['staff'] . "'");
$name = $res3->fetch_column();
if (isset($_POST['submit'])) {
  $mess = $_POST['mess'];
  $messcode = explode(" ", $mess);
  $info1 = $_POST['info1'];
  $info2 = $_POST['info2'];
  $info3 = $_POST['info3'];
  $info4 = $_POST['info4'];
  $info5 = $_POST['info5'];
  $info6 = $_POST['info6'];
  $info7 = $_POST['info7'];
  $info8 = $_POST['info8'];
  $info9 = $_POST['info9'];
  $info10 = $_POST['info10'];
  $info11 = $_POST['info11'];
  $info12 = $_POST['info12'];
  $info13 = $_POST['info13'];
  // if(isempty($info1)|| isempty($info2)|| isempty($info3) || isempty($info4) || isempty($info5) || isempty($info6)|| isempty($info7)|| isempty($info8)|| isempty($info9)|| isempty($info10) || isempty($info11)|| isempty($info12) || isempty($info13)){
  //   echo "<script>alert('Grade all the fields')</script>";
  // }

  $observation1 = $_POST['observe1'];
  $observation2 = $_POST['observe2'];
  $observation3 = $_POST['observe3'];
  $observation4 = $_POST['observe4'];

  $vMemeber1 = $_POST['vm1'];
  $vMemeber2 = $_POST['vm2'];
  $vMemeber3 = $_POST['vm3'];
  $vMemeber4 = $_POST['vm4'];
  $vMemeber5 = $_POST['vm5'];

  $sql2 = "update tblinspection  set inspectionDate=CURRENT_DATE(),washRoom='" . $info1 . "',study='" . $info2 . "',hotWater='" . $info3 . "',cleaniliness='" . $info4 . "',food='" . $info5 . "',powerBackup='" . $info6 . "',mobileUsage='" . $info7 . "',outing='" . $info8 . "',moneyMatters='" . $info9 . "',documents='" . $info10 . "',mentorConn='" . $info11 . "',timeTable='" . $info12 . "',ccCamera='" . $info13 . "',observation1='" . $observation1 . "',observation2='" . $observation2 . "',observation3='" . $observation3 . "',observation4='" . $observation4 . "',vMember1='" . $name . "',vMember2='" . $vMemeber1 . "',vMember3='" . $vMemeber2 . "',vMember4='" . $vMemeber3 . "',vMember5='" . $vMemeber4 . "',vMember6='" . $vMemeber5 . "' where messCode='" . $messcode[0] . "'";
  // echo $sql2;
  if ($maincon->query($sql2)) {

    echo "<script>alert('Success')</script>";
  } else {
    echo "<script>alert('Error')</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inspection</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/style.css" />
  <!-- Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Geologica:wght@300&family=Oswald:wght@200&family=Poppins:wght@700&display=swap"
    rel="stylesheet" />

  <link
    href="https://fonts.googleapis.com/css2?family=Geologica:wght@300&family=Oswald:wght@200&family=Poppins:wght@700&display=swap"
    rel="stylesheet" />

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
  <style>
  body {
    background-color: #dce7ef;
  }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top w-100">
    <div class="container-fluid px-3">
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
            <a class="nav-link " aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="inspect.php">Inspections</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="complaint.php">Complaint</a>
          </li>

        </ul>
        <a href="../../logout.php" class="btn btn-danger">Logout</a>
      </div>
    </div>
  </nav>
  <div class="container my-4">
    <!-- Image and text -->
    <form method="POST">
      <div class="input-group mb-3">
        <select class="custom-select" id="inputGroupSelect01" name="mess" required>
          <option value="">Select the pg name</option>
          <?php
          include('../../dbmain_conn.php');

          $sql1 = "select * from tblmess";
          $res1 = $maincon->query($sql1);
          if ($res1->num_rows > 0) {
            while ($row1 = $res1->fetch_assoc()) {
              echo "<option value='" . $row1['code'] . " " . $row1['messName'] . "'>" . $row1['code'] . "-" . $row1['messName'] . "</option>";
            }
          }
          ?>
        </select>
      </div>
      <div>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">SL NO</th>
              <th scope="col">Particulars</th>
              <th scope="col">GOOD</th>
              <th scope="col">AVERAGE</th>
              <th scope="col">BAD</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Washroom Facility</td>
              <td><input type="radio" name="info1" value="Good" id="" required /></td>
              <td><input type="radio" name="info1" value="Average" id="" /></td>
              <td><input type="radio" name="info1" value="Bad" id="" /></td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Study Facility</td>
              <td><input type="radio" name="info2" value="Good" id="" required /></td>
              <td><input type="radio" name="info2" value="Average" id="" /></td>
              <td><input type="radio" name="info2" value="Bad" id="" /></td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>Hot Water Facility</td>
              <td><input type="radio" name="info3" value="Good" id="" required /></td>
              <td><input type="radio" name="info3" value="Average" id="" /></td>
              <td><input type="radio" name="info3" value="Bad" id="" /></td>
            </tr>
            <tr></tr>
            <tr>
              <th scope="row">4</th>
              <td>Cleanliness</td>
              <td><input type="radio" name="info4" value="Good" id="" required /></td>
              <td><input type="radio" name="info4" value="Average" id="" /></td>
              <td><input type="radio" name="info4" value="Bad" id="" /></td>
            </tr>

            <tr>
              <th scope="row">5</th>
              <td>Food</td>
              <td><input type="radio" name="info5" value="Good" id="" required /></td>
              <td><input type="radio" name="info5" value="Average" id="" /></td>
              <td><input type="radio" name="info5" value="Bad" id="" /></td>
            </tr>
            <tr>
              <th scope="row">6</th>
              <td>Power back up</td>
              <td><input type="radio" name="info6" value="Good" id="" required /></td>
              <td><input type="radio" name="info6" value="Average" id="" /></td>
              <td><input type="radio" name="info6" value="Bad" id="" /></td>
            </tr>
            <tr>
              <th scope="row">7</th>
              <td>Mobile usage</td>
              <td><input type="radio" name="info7" value="Good" id="" required /></td>
              <td><input type="radio" name="info7" value="Average" id="" /></td>
              <td><input type="radio" name="info7" value="Bad" id="" /></td>
            </tr>
            <tr>
              <th scope="row">8</th>
              <td>Outing</td>
              <td><input type="radio" name="info8" value="Good" id="" required /></td>
              <td><input type="radio" name="info8" value="Average" id="" /></td>
              <td><input type="radio" name="info8" value="Bad" id="" /></td>
            </tr>
            <tr>
              <th scope="row">9</th>
              <td>Money matters</td>
              <td><input type="radio" name="info9" value="Good" id="" required /></td>
              <td><input type="radio" name="info9" value="Average" id="" /></td>
              <td><input type="radio" name="info9" value="Bad" id="" /></td>
            </tr>
            <tr>
              <th scope="row">10</th>
              <td>Documents</td>
              <td><input type="radio" name="info10" value="Good" id="" required /></td>
              <td><input type="radio" name="info10" value="Average" id="" /></td>
              <td><input type="radio" name="info10" value="Bad" id="" /></td>
            </tr>
            <tr>
              <th scope="row">11</th>
              <td>Mentor connection</td>
              <td><input type="radio" name="info11" value="Good" id="" required /></td>
              <td><input type="radio" name="info11" value="Average" id="" /></td>
              <td><input type="radio" name="info11" value="Bad" id="" /></td>
            </tr>
            <tr>
              <th scope="row">12</th>
              <td>Time table availability</td>
              <td><input type="radio" name="info12" value="Good" id="" required /></td>
              <td><input type="radio" name="info12" value="Average" id="" /></td>
              <td><input type="radio" name="info12" value="Bad" id="" /></td>
            </tr>
            <tr>
              <th scope="row">13</th>
              <td>C.C Camera</td>
              <td><input type="radio" name="info13" value="Good" id="" required /></td>
              <td><input type="radio" name="info13" value="Average" id="" /></td>
              <td><input type="radio" name="info13" value="Bad" id="" /></td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- end -->
      <div class="mt-5">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col" colspan="2">Any other observations</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="observe1"></textarea>
              </td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>
                <textarea class="form-control" id="exampleFormControlTextarea2" rows="2" name="observe2"></textarea>
              </td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>
                <textarea class="form-control" id="exampleFormControlTextarea3" rows="2" name="observe3"></textarea>
              </td>
            </tr>
            <tr>
              <th scope="row">4</th>
              <td>
                <textarea class="form-control" id="exampleFormControlTextarea4" rows="2" name="observe4"></textarea>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- End -->
      <div class="mt-5">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">SL NO</th>
              <th scope="col">Visiting Team Members</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>
                <input type="text" class="form-control" placeholder="Enter Name" name="vm1" />
              </td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>
                <input type="text" class="form-control" placeholder="Enter Name" name="vm2" />
              </td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Name" name="vm3" />
              </td>
            </tr>
            <tr>
              <th scope="row">4</th>
              <td>
                <input type="text" class="form-control" placeholder="Enter Name" name="vm4" />
              </td>
            </tr>
            <tr>
              <th scope="row">5</th>
              <td>
                <input type="text" class="form-control" placeholder="Enter Name" name="vm5" />
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <input class="btn btn-primary" type="submit" name="submit" value="Submit" />
  </div>
  </form>

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    &copy; Copyright <strong><span>SDM</span></strong>. All Rights Reserved
  </footer>
  <!-- End Footer -->

  <!-- JavaScript -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
  </script>
  <!-- MDB -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.js"></script>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
    integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous">
  </script>
</body>

</html>