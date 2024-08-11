<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Office Login</title>
  <link rel="stylesheet" href="styles.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href="../img/sdm_logo.png" rel="icon" />
  <style>
  @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200&family=Poppins:wght@700&display=swap');

  .al {
    /* display:none; */
    margin-top: .5rem;
    font-size: 0.9rem;
  }
  </style>
</head>
<?php
session_start();
include('../dbmain_conn.php');
if (isset($_POST['officelogin'])) {
    $uname = filter_input(INPUT_POST, 'userid', FILTER_SANITIZE_SPECIAL_CHARS);
    $pass = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);


    $sql = "select * from tbloffice where userid='" . $uname . "' and pass='" . md5($pass) . "'";
    $res = $maincon->query($sql);
    if ($res->num_rows > 0) {
        $sql1 = "select college as clg from tbloffice where userid='" . $uname . "'";
        $row = $maincon->query($sql1);
        $_SESSION['office'] = $row->fetch_column() . " Office";
        $maincon->close();
        header('Location: ./admin-dashboard/html/index.php');
    } else {
        $_SESSION["status"] = "Incorrect Username or Password";
    }
}

?>

<body>
  <!-- -- -->
  <div class="main-container  ">

    <div class="container w-50 h-50
          border rounded border-dark p-5">
      <section class="vh-100 ">
        <div class="container-fluid h-custom">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5 ">
              <img src="./Img/sdm_logo.png" class=" img-fluid" alt="Sample image">
            </div>
            <div class="col-md-7 col-lg-6  ">
              <form method="POST">
                <div>
                  <h4 class="text-center">Office Login</h4><br>
                </div>


                <!-- Email input -->
                <div class="form-outline mb-3 ">
                  <input type="text" id="form3Example3" class="form-control form-control-lg"
                    placeholder="Enter a User ID " name="userid" required />

                </div>

                <!-- Password input -->
                <div class="form-outline mb-3">
                  <input type="password" id="form3Example4" class="form-control form-control-lg"
                    placeholder="Enter password" name="password" required />

                </div>

                <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
                  href="reset_password.php">
                  Forgot password ?
                </a>

                <div class="text-center text-lg-start mt-1 pt-2">
                  <button type="submit" class="btn btn-primary btn-lg"
                    style="padding-left: 2.5rem; padding-right: 2.5rem;" name="officelogin">Login</button>

                </div>



              </form>

              <?php
                            if (isset($_SESSION['status'])) {
                                echo ' <div class="alert alert-danger al d-flex align-content-center" role="alert">' . $_SESSION["status"] . '</div>';
                                unset($_SESSION['status']);
                            }
                            ?>


            </div>
          </div>
        </div>
      </section>
    </div>
  </div>

  <!-- -------------- -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
  </script>

</body>

</html>