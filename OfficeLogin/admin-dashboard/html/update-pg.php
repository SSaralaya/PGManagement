<?php
include('../../officeCheck.php');
include('../../../dbmain_conn.php');
$updatesrc = false;
$query1 = "select count(leaveId) as tot_leave from tblleave where status='Requested'";
$r1 = $maincon->query($query1);
$leave = $r1->fetch_column();
$query2 = "select count(complaintId) as tot_complaint from tblcomplaint where status='Unsolved'";
$r2 = $maincon->query($query2);
$complaint = $r2->fetch_column();
$query3 = "select count(rollno) as tot_delete from tbltemp";
$r3 = $maincon->query($query3);
$delete = $r3->fetch_column();
$total = $leave + $complaint + $delete;
?>

<!DOCTYPE html>
<?php

$mName = $owner = $address = $email = $cNo1 = $cNo2 = $cNo3 = $distance = $type = $fType = $deposit = $mFees = $strength = $vacancy = "";

if (isset($_POST['updateSearch'])) {
  $updatesrc = true;
  $srcCode = $_POST['searchcode'];
  $sql = "select * from tblmess where code='" . $srcCode . "'";
  $res = $maincon->query($sql);
  if ($res->num_rows > 0) {
    echo " <style>
        .update-form{
            display:block;
        }</style>";
    while ($row = $res->fetch_assoc()) {
      $_SESSION['code'] = $srcCode;
      $mName = $row['messName'];
      $owner = $row['owner'];
      $address = $row['address'];
      $distance = $row['distance'];
      $email = $row['emailid'];
      $cNo1 = $row['contactNo1'];
      $cNo2 = $row['contactNo2'];
      $cNo3 = $row['contactNo3'];
      $type = $row['messType'];
      $fType = $row['foodType'];
      $deposit = $row['deposit'];
      $mFees = $row['monthRent'];
      $strength = $row['strength'];
      $vacancy = $row['vacancy'];
    }
  } else {
    echo "<style>
        .no-data{
            display:block;
        }</style>";
  }
}

if (isset($_POST['update'])) {
  $code = $_POST['UCode'];
  $mName = $_POST['UmName'];
  $owner = $_POST['Uowner'];
  $address = $_POST['Uaddress'];
  $distance = $_POST['Udistance'];
  $Uemail = $_POST['Uemailid'];
  $cNo1 = $_POST['Ucontact1'];
  if (!empty($_POST['Ucontact2'])) {
    $cNo2 = $_POST['Ucontact2'];
  } else {
    $cNo2 = 'NULL';
  }
  if (!empty($_POST['Ucontact3'])) {
    $cNo3 = $_POST['Ucontact3'];
  } else {
    $cNo3 = 'NULL';
  }
  $type = $_POST['Utype'];
  $fType = $_POST['Ufoodtype'];
  $deposit = $_POST['Udeposit'];
  $mFees = $_POST['UmFees'];
  $strength = $_POST['Ustrength'];
  $vacancy = $_POST['Uvacancy'];


  include('../../../dbmain_conn.php');

  $sql2 = "update tblmess set messName='" . $mName . "',owner='" . $owner . "',address='" . $address . "',emailid='" . $Uemail . "',contactNo1=" . $cNo1 . ",contactNo2=" . $cNo2 . ",contactNo3=" . $cNo3 . ",messType='" . $type . "',foodType='" . $fType . "',deposit=" . $deposit . ",monthRent=" . $mFees . ",distance='" . $distance . "',strength=" . $strength . ",vacancy=" . $vacancy . " where code='" . $code . "'";

  if ($maincon->query($sql2)) {
    if ($email != $Uemail) {
      $sql3 = "update tblpglogin set emailid='" . $Uemail . "' where pgcode='" . $code . "'";
      if ($maincon->query($sql3)) {
      } else {
        echo "<script>alert('Error')</script>";
      }
    }
    echo "<script>alert('Update Successfull')</script>";
  }
  $mName = $owner = $address = $email = $cNo1 = $cNo2 = $cNo3 = $distance = $type = $fType = $deposit = $mFees = $strength = $vacancy = "";
}
?>



<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Update PG</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="../assets/img/Logo/sdm_logo.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="../assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <!-- Page CSS -->

  <!-- Helpers -->
  <script src="../assets/vendor/js/helpers.js"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="../assets/js/config.js"></script>
</head>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->

      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
          <a href="index.php" class="app-brand-link">
            <span class="app-brand-logo demo">
              <img src="../assets/img/Logo/sdm_logo.png" style="width:30px" alt="" srcset="">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">SDM</span>
          </a>

          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
          <!-- Dashboard -->
          <li class="menu-item">
            <a href="index.php" class="menu-link">
              <i class="menu-icon tf-icons bx bx-home-circle"></i>
              <div data-i18n="Analytics">Dashboard</div>
            </a>
          </li>

          <!-- Layouts -->


          <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pages</span>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-envelope"></i>
              <div data-i18n="Account Settings">Email update</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item">
                <a href="account.php" class="menu-link">
                  <div data-i18n="Account">Email Update</div>
                </a>
              </li>
            </ul>
          </li>

          <!-- Notifications -->
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">

              <i class="menu-icon tf-icons bx bxs-bell"></i>
              <div data-i18n="Account Settings">Notifications<?php if ($total > 0) : ?><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-dot text-danger" viewBox="0 0 16 16">
                  <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                </svg><?php endif; ?></div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item">
                <a href="leave.php" class="menu-link">
                  <div data-i18n="Leave">Leave<?php if ($leave > 0) : ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-dot text-danger" viewBox="0 0 16 16">
                      <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                    </svg><?php endif; ?>
                  </div>
                </a>
              </li>
              <li class="menu-item">
                <a href="complaint.php" class="menu-link">
                  <div data-i18n="Complain">Complaint
                    <?php if ($complaint > 0) : ?>
                      <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-dot text-danger" viewBox="0 0 16 16">
                        <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                      </svg><?php endif; ?>
                  </div>
                </a>
              </li>
              <li class="menu-item">
                <a href="n-delete-student.php" class="menu-link">
                  <div data-i18n="Notifications">Delete Student<?php if ($delete > 0) : ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-dot text-danger" viewBox="0 0 16 16">
                      <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                    </svg><?php endif; ?>
                  </div>
                </a>
              </li>
            </ul>
          </li>
          <!-- End Notifications -->
          <!-- Forms & Tables -->
          <li class="menu-header small text-uppercase"><span class="menu-header-text">Operations</span></li>
          <!-- Forms -->
          <li class="menu-item ">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bxs-plus-circle"></i>
              <div data-i18n="Form Elements">Insert</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item ">
                <a href="pg-add.php" class="menu-link">
                  <div data-i18n="PG">PG</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="committee-add.php" class="menu-link">
                  <div data-i18n="Committee members">Committee members</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="student-add.php" class="menu-link">
                  <div data-i18n="Student">Student</div>
                </a>
              </li>
            </ul>
          </li>


          <!-- Forms -->
          <li class="menu-item active open">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bxs-edit"></i>
              <div data-i18n="Form Elements">Update</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item active">
                <a href="update-pg.php" class="menu-link">
                  <div data-i18n="PG">PG</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="update-committee.php" class="menu-link">
                  <div data-i18n="Committee members">Committee members</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="update-student.php" class="menu-link">
                  <div data-i18n="Student">Student</div>
                </a>
              </li>
            </ul>
          </li>

          <!-- Forms -->
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bxs-trash-alt"></i>
              <div data-i18n="Form Elements">Delete</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item">
                <a href="delete-pg.php" class="menu-link">
                  <div data-i18n="PG">PG</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="delete-committee.php" class="menu-link">
                  <div data-i18n="Committee members">Committee members</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="delete-student.php" class="menu-link">
                  <div data-i18n="Student">Student</div>
                </a>
              </li>
            </ul>
          </li>

          <!-- View-->
          <li class="menu-header small text-uppercase"><span class="menu-header-text">View</span></li>
          <!-- Cards -->
          <li class="menu-item">
            <a href="view-pg.php" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-building-house"></i>
              <div data-i18n="Basic">PG Review</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="view-committee.php" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-group"></i>

              <div data-i18n="Basic">Committee Members</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="view-student.php" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-user"></i>

              <div data-i18n="Basic">Student</div>
            </a>
          </li>


          <!-- View-->
          <li class="menu-item">
            <a href="deleted-students.php" class="menu-link">
              <i class="menu-icon fa-solid fa-file"></i>
              <div data-i18n="Basic">Deleted Students</div>
            </a>
          </li>

          <!-- View-->

          <!-- View-->
          <li class="menu-header small text-uppercase"><span class="menu-header-text">NOTICE </span></li>
          <li class="menu-item">
            <a href="notice.php" class="menu-link">
              <i class="menu-icon fa-regular fa-envelope-open"></i>
              <div data-i18n="Basic">Notice</div>
            </a>
          </li>

          <li class="menu-header small text-uppercase"><span class="menu-header-text">Print</span></li>
          <!-- Cards -->
          <li class="menu-item">
            <a href="all-student-list.php" class="menu-link">
              <i class="menu-icon fa-solid fa-print"></i>
              <div data-i18n="Basic">All Student List</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="pg-wise.php" class="menu-link">
              <i class="menu-icon fa-solid fa-print"></i>
              <div data-i18n="Basic">PG Wise</div>
            </a>
          </li>


        </ul>
      </aside>
      <!-- / Menu -->

      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->

        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="bx bx-menu bx-sm"></i>
            </a>
          </div>

          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav d-flex align-items-center justify-content-center align-items-center">
              <nav aria-label="breadcrumb  navbar-nav ">
                <ol class="breadcrumb mt-3">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item">Update</li>
                  <li class="breadcrumb-item active" aria-current="page">PG</li>
                </ol>
              </nav>
            </div>
            <!-- /Search -->

            <ul class="navbar-nav flex-row align-items-center ms-auto">
              <!-- Place this tag where you want the button to render. -->


              <!-- User -->
              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                  <div class="avatar avatar-online">
                    <img src="../assets/img/avatars/account.png" alt class="w-px-40 h-auto rounded-circle" />
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar avatar-online">
                            <img src="../assets/img/avatars/account.png" alt class="w-px-40 h-auto rounded-circle" />
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <span class="fw-semibold d-block"><?php echo $_SESSION['office']; ?></span>
                          <small class="text-muted">Admin</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="../../../logout.php">
                      <i class="bx bx-power-off me-2"></i>
                      <span class="align-middle">Log Out</span>
                    </a>
                  </li>
                </ul>
              </li>
              <!--/ User -->
            </ul>
          </div>
        </nav>

        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="d-flex align-items-center justify-content-center">
            <!-- Search -->
            <form class="d-flex m-4 w-100 align-items-center justify-content-center" method="POST">
              <input class="form-control mr-sm-2 w-50" type="text" placeholder="Enter the PG Code......." aria-label="Search" required name="searchcode">
              <button class="btn bg-primary text-white " type="submit" style="margin-left: 0.2rem;" name="updateSearch">Search</button>
            </form>

            <!-- /Search -->
          </div>

          <div class="container-xxl flex-grow-1 container-p-y">
            <?php
            if ($mName) :
            ?>
              <div class="row d-flex justify-content-center">
                <div class="col-xl-6 ">
                  <!-- HTML5 Inputs -->
                  <form action="" method="POST" enctype="multipart/form-data" class="update-form">
                    <div class="card mb-4">
                      <h5 class="card-header text-center">Update PG</h5>
                      <div class="card-body">
                        <div class="mb-3 row">
                          <label for="html5-text-input" class="col-md-4 col-form-label">Code No</label>
                          <div class="col-md-8">
                            <input class="form-control " type="text" <?php if (isset($_SESSION['code'])) : ?> value="<?php
                                                                                                                      echo $_SESSION['code'];
                                                                                                                    endif;
                                                                                                                      ?>" id="html5-text-input" name="UCode" readonly required />
                          </div>
                        </div>

                        <div class="mb-3 row">
                          <label for="html5-text-input" class="col-md-4
                                            col-form-label">Mess Name</label>
                          <div class="col-md-8">
                            <input class="form-control" type="text" name="UmName" value="<?php echo $mName ?>" required />
                          </div>
                        </div>

                        <div class="mb-3 row">
                          <label for="html5-text-input" class="col-md-4
                                            col-form-label">Owner Name</label>
                          <div class="col-md-8">
                            <input class="form-control" type="text" name="Uowner" value="<?php echo $owner; ?>" required />
                          </div>
                        </div>

                        <div class="mb-3 row">
                          <label for="html5-email-input" class="col-md-4 col-form-label">Address</label>
                          <div class="col-md-8">
                            <textarea class="form-control" type="text" rows="3" name="Uaddress" required><?php echo $address; ?></textarea>
                          </div>
                        </div>

                        <div class="mb-3 row">
                          <label for="html5-text-input" class="col-md-4 col-form-label">Email Id</label>
                          <div class="col-md-8">
                            <input class="form-control" type="email" name="Uemailid" value="<?php echo $email; ?>" required />
                          </div>
                        </div>

                        <div class="mb-3 row">
                          <label for="html5-text-input" class="col-md-4 col-form-label">Contact Number 1</label>
                          <div class="col-md-8">
                            <input class="form-control" type="text" id="ph_no1" onkeyup="check_no(ph_no1);" minlength="10" maxlength="10" name="Ucontact1" value="<?php echo $cNo1; ?>" required />
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label for="html5-text-input" class="col-md-4 col-form-label">Contact Number 2(Optional)</label>
                          <div class="col-md-8">
                            <input class="form-control" type="text" id="ph_no2" onkeyup="check_no(ph_no2);" minlength="10" maxlength="10" name="Ucontact2" value="<?php echo $cNo2; ?>" />
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label for="html5-text-input" class="col-md-4 col-form-label">Contact Number 3(Optional)</label>
                          <div class="col-md-8">
                            <input class="form-control" type="text" id="ph_no3" onkeyup="check_no(ph_no3);" minlength="10" maxlength="10" name="Ucontact3" value="<?php echo $cNo3; ?>" />
                          </div>
                        </div>

                        <div class="mb-3 row">
                          <label for="html5-text-input" class="col-md-4
                                            col-form-label">Distance from College</label>
                          <div class="col-md-8">
                            <input class="form-control" type="text" name="Udistance" value="<?php echo $distance; ?>" required />
                          </div>
                        </div>

                        <div class="mb-3 row">
                          <label for="html5-text-input" class="col-md-4 col-form-label">Type</label>
                          <div class="col-md-8">
                            <input type="radio" name="Utype" value="Boys" <?php if ($type == 'Boys') : ?>checked <?php endif; ?> />
                            <label for="html5-text-input" class="col-md-2 col-form-label">Boys</label>
                            <input type="radio" name="Utype" value="Girls" <?php if ($type == 'Girls') : ?>checked <?php endif; ?> />
                            <label for="html5-text-input" class="col-md-2 col-form-label">Girls</label>
                          </div>
                        </div>

                        <div class="mb-3 row">
                          <label for="html5-text-input" class="col-md-4 col-form-label">Food Type</label>
                          <div class="col-md-8">
                            <input type="radio" name="Ufoodtype" value="Veg" <?php if ($fType == 'Veg') : ?>checked <?php endif; ?> />
                            <label for="html5-text-input" class="col-md-2 col-form-label">Veg</label>
                            <input type="radio" name="Ufoodtype" value="Non-Veg" <?php if ($fType == 'Non-Veg') : ?>checked <?php endif; ?> />
                            <label for="html5-text-input" class="col-md-2 col-form-label">Non-Veg</label>
                          </div>
                        </div>

                        <div class="mb-3 row">
                          <label for="html5-date-input" class="col-md-4 col-form-label">Annual Deposit</label>
                          <div class="col-md-8">
                            <input class="form-control" type="number" id="adeposit" name="Udeposit" value="<?php echo $deposit; ?>" required />
                          </div>
                        </div>

                        <div class="mb-3 row">
                          <label for="html5-date-input" class="col-md-4 col-form-label">Monthly Fees</label>
                          <div class="col-md-8">
                            <input class="form-control" type="number" id="mrent" name="UmFees" value="<?php echo $mFees; ?>" required />
                          </div>
                        </div>

                        <div class="mb-3 row">
                          <label for="html5-date-input" class="col-md-4 col-form-label">Total Strength</label>
                          <div class="col-md-8">
                            <input class="form-control" type="number" id="field1" name="Ustrength" value="<?php echo $strength; ?>" required />
                          </div>
                        </div>

                        <div class="mb-3 row">
                          <label for="html5-date-input" class="col-md-4 col-form-label">Vacancy</label>
                          <div class="col-md-8">
                            <input class="form-control" type="number" id="field2" name="Uvacancy" value="<?php echo $vacancy; ?>" required />
                          </div>
                        </div>

                        <div class="d-flex justify-content-around mt-4">
                          <div>
                            <input class="btn btn-primary" type="submit" value="Update" name="update">
                          </div>

                        </div>
                      </div>
                    </div>

                  </form>

                  <!-- File input -->

                  <!-- <div class="no-data">
                                <img src="../../../img/no-data.jpg" alt="No Data">
                            </div>
                                 -->

                </div>
              </div>
            <?php elseif ($updatesrc == true) : ?>
              <div class="no-record w-100 h-75  d-flex align-content-center justify-content-center">
                <img src="../../../IMG/no-data.png" alt="No Data Found">
              </div>
            <?php endif;
            $updatesrc = false; ?>
          </div>

          <div>

          </div>

        </div>
        <!-- / Content -->

        <!-- Footer -->
        <footer class="content-footer footer bg-footer-theme ">
          <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column" style="background-color: #fff; color: #748496;">
            <div class="mb-2 mb-md-0 d-flex justify-content-center w-100 p-2 align-content-center">
              <p> <strong> © SDM PUC | Ujire, All Right Reserved.</strong></p>
            </div>
          </div>
        </footer>
        <!-- / Footer -->

        <div class="content-backdrop fade"></div>
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


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
  </script>
  <script src="https://kit.fontawesome.com/a6bcfa9fe8.js" crossorigin="anonymous"></script>
  <script>
    const field1 = document.getElementById('field1');
    const field2 = document.getElementById('field2');
    const field3 = document.getElementById('adeposit');
    const field4 = document.getElementById('mrent');

    field3.addEventListener('input', () => {
      if (parseInt(field3.value) < 0) {
        field3.value = '';
        alert('Annual deposit cannot be negative.');
      }
    })
    field4.addEventListener('input', () => {
      if (parseInt(field4.value) < 0) {
        field4.value = '';
        alert('Month Rent cannot be negative.');
      }
    })

    field1.addEventListener('input', () => {
      if (parseInt(field1.value) < 0) {
        field1.value = '';
        alert('Strength cannot be negative.');
      }
    })

    field2.addEventListener('input', () => {
      if (parseInt(field2.value) < 0) {
        field2.value = '';
        alert('Strength cannot be negative.');
      }
      if (parseInt(field2.value) > parseInt(field1.value)) {
        field2.value = '';
        alert('Strength should not exceed Vacancy.');
      }
    });

    function check_no(ph_no) {
      if (!Number.isFinite(Number(ph_no.value))) {
        ph_no.value = ph_no.value.substr(0, (ph_no.value).length - 1);
      }
    }
  </script>
</body>

</html>