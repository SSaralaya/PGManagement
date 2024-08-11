<?php
session_start();
$_SESSION["statuslg"] = "";
if (isset($_POST['login'])) {

  include('../dbmain_conn.php');

  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

  $sql1 = "select pgcode as mCode from tblpglogin where emailid='" . $email . "' and password='" . md5($password) . "'";
  $res1 = $maincon->query($sql1);

  if ($res1->num_rows > 0) {
    $_SESSION['pg'] = $res1->fetch_column();
    $maincon->close();
    header('Location: ./PG-Owner/index.php');
  } else {
    $_SESSION["statuslg"] = "Incorrect Username or Password";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PG-Owner Login</title>
  <link href="../img/sdm_logo.png" rel="icon" />
  <style>
  @import url("https://fonts.googleapis.com/css?family=Raleway:400,700");

  body {
    background: #c0c0c0;
    font-family: Raleway, sans-serif;
    color: #666;
    width: 100vw;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    background: hsla(213, 77%, 14%, 1);

    background: linear-gradient(90deg, hsla(213, 77%, 14%, 1) 0%, hsla(202, 27%, 45%, 1) 100%);

    background: -moz-linear-gradient(90deg, hsla(213, 77%, 14%, 1) 0%, hsla(202, 27%, 45%, 1) 100%);

    background: -webkit-linear-gradient(90deg, hsla(213, 77%, 14%, 1) 0%, hsla(202, 27%, 45%, 1) 100%);

    filter: progid: DXImageTransform.Microsoft.gradient(startColorstr="#08203E", endColorstr="#557C93", GradientType=1);
  }

  section {
    width: 40%;
  }

  .login {
    margin: 20px auto;
    padding: 40px 50px;
    max-width: 500px;
    border-radius: 5px;
    background: #fff;
    box-shadow: 1px 1px 1px #666;
  }

  .login input {
    width: 100%;
    display: block;
    box-sizing: border-box;
    margin: 10px 0;
    padding: 14px 12px;
    font-size: 16px;
    border-radius: 2px;
    font-family: Raleway, sans-serif;
  }

  .login input[type="text"],
  .login input[type="password"] {
    border: 1px solid #c0c0c0;
    transition: 0.2s;
  }

  .login input[type="text"]:hover {
    border-color: #f44336;
    outline: none;
    transition: all 0.2s ease-in-out;
  }

  .login input[type="submit"] {
    border: none;
    background: #ef5350;
    color: white;
    font-weight: bold;
    transition: 0.2s;
    margin: 20px 0px;
  }

  .login input[type="submit"]:hover {
    background: #f44336;
  }

  .login h2 {
    margin: 20px 0 0;
    color: #ef5350;
    font-size: 28px;
  }

  .login p {
    margin-bottom: 40px;
  }

  .links {
    display: table;
    width: 100%;
    box-sizing: border-box;
    border-top: 1px solid #c0c0c0;
    margin-bottom: 10px;
  }

  .links a {
    display: table-cell;
    padding-top: 10px;
  }

  .links a:first-child {
    text-align: left;
  }

  .links a:last-child {
    text-align: right;
  }

  .login h2,
  .login p,
  .login a {
    text-align: center;
  }

  .login a {
    text-decoration: none;
    font-size: 0.8em;
  }

  .login a:visited {
    color: inherit;
  }

  .login a:hover {
    text-decoration: underline;
  }

  @media (max-width:40em) {
    section {
      width: 100%;
    }
  }
  </style>
</head>

<body>
  <section>
    <form method="POST" class="login">
      <h2>Welcome, PG Owner!</h2>
      <p>Please log in</p>
      <input type="email" name="email" required placeholder="Email" />
      <input type="password" name="password" required />
      <input type="submit" name="login" value="Log In" />

      <div style="margin-bottom:30px; text-align:center; color:#b01010;">
        <p><?php if (isset($_SESSION['statuslg'])) {
              echo $_SESSION['statuslg'];
            } ?></p>
      </div>

      <div class="links">
        <a href="reset_password.php">Forgot password</a>
      </div>
    </form>
  </section>
</body>

</html>