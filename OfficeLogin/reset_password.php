<style>
  .mainDiv {
    display: flex;
    min-height: 100%;
    align-items: center;
    justify-content: center;
    background-color: #f9f9f9;
    font-family: 'Open Sans', sans-serif;
  }

  .cardStyle {
    width: 500px;
    border-color: white;
    background: #fff;
    padding: 36px 0;
    border-radius: 4px;
    margin: 30px 0;
    box-shadow: 0px 0 2px 0 rgba(0, 0, 0, 0.25);
  }

  #signupLogo {
    max-height: 100px;
    margin: auto;
    display: flex;
    flex-direction: column;
  }

  .formTitle {
    font-weight: 600;
    margin-top: 20px;
    color: #2F2D3B;
    text-align: center;
  }

  .inputLabel {
    font-size: 12px;
    color: #555;
    margin-bottom: 6px;
    margin-top: 24px;
  }

  .inputDiv {
    width: 70%;
    display: flex;
    flex-direction: column;
    margin: auto;
  }

  input {
    height: 40px;
    font-size: 16px;
    border-radius: 4px;
    border: none;
    border: solid 1px #ccc;
    padding: 0 11px;
  }

  input:disabled {
    cursor: not-allowed;
    border: solid 1px #eee;
  }

  .buttonWrapper {
    margin-top: 40px;
  }

  .submitButton {
    width: 70%;
    height: 40px;
    margin: auto;
    display: block;
    color: #fff;
    background-color: #065492;
    border-color: #065492;
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.12);
    box-shadow: 0 2px 0 rgba(0, 0, 0, 0.035);
    border-radius: 4px;
    font-size: 14px;
    cursor: pointer;
  }

  .submitButton:disabled,
  button[disabled] {
    border: 1px solid #cccccc;
    background-color: #cccccc;
    color: #666666;
  }

  #loader {
    position: absolute;
    z-index: 1;
    margin: -2px 0 0 10px;
    border: 4px solid #f3f3f3;
    border-radius: 50%;
    border-top: 4px solid #666666;
    width: 14px;
    height: 14px;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
  }

  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(360deg);
    }
  }

  .alert-success {
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
  }

  .alert-danger {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
    ;
  }
</style>
<?php
session_start();
include('../dbmain_conn.php');
include('../vendor/autoload.php');

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Firebase\JWT\JWT;
// use Firebase\JWT\Key;

function send_email($email, $name, $jwt)
{
  if (!defined("SEND_MAIL"))
    return false;

  try {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = "smtp.gmail.com";
    $mail->Username = ""; // mail
    $mail->Password = ""; // pass

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    $mail->setFrom("logincode22@gmail.com", "PHP"); // from
    $mail->addAddress($email, $name); // to

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Reset link from localhost';
    $mail->Body    = "Here is your reset link its is valid up to 5 minutes<br> <a href='http://localhost/PGManagement/OfficeLogin/reset_password_code.php?token=$jwt&email=$email'>Click here</a>";
    $mail->AltBody = 'http://localhost/PGManagement/OfficeLogin/reset_password_code.php?token=$jwt&email=$email';

    $mail->send();

    return true;
  } catch (Exception $e) {
    return false;
  }
}
if (isset($_POST["r_btn"])) {
  $email = filter_input(INPUT_POST, "r_email", FILTER_SANITIZE_EMAIL);
  if (!empty($email)) {
    $res = $maincon->query("SELECT * FROM tbloffice WHERE userid='$email'");
    if ($res->num_rows > 0) {
      $row = $res->fetch_array();
      $token = md5(rand());
      if ($maincon->query("UPDATE tbloffice SET verify_token='$token' WHERE userid='$email'")) {
        $payload = [
          'verify_token' => $token,
          'email' => $email,
          'exp' => time() + 300
        ];
        $jwt = JWT::encode($payload, "1234", 'HS256');
        define("SEND_MAIL", true);
        if (send_email($email, $row["college"] . " College", $jwt)); {
          $_SESSION["class"] = "success";
          $_SESSION["status"] = "Reset link is sent to $email";
        }
      } else {
        $_SESSION["class"] = "danger";
        $_SESSION["status"] = "Something went wrong...";
      }
    } else {
      $_SESSION["class"] = "danger";
      $_SESSION["status"] = "Invalid Email";
    }
  } else {
    $_SESSION["class"] = "danger";
    $_SESSION["status"] = "Email required";
  }
}
?>
<?php
if (isset($_SESSION["status"])) {
  echo '<script>alert("' . $_SESSION["status"] . '")</script>';
  unset($_SESSION["status"]);
  unset($_SESSION["class"]);
}
?>
<div class="mainDiv">
  <div class="cardStyle">
    <form method="post" name="signupForm" id="signupForm">

      <!-- <img src="" id="signupLogo"/> -->

      <h2 class="formTitle">
        Enter email address to get reset link.
      </h2>

      <div class="inputDiv">
        <label class="inputLabel" for="password">Email</label>
        <input type="email" id="email" name="r_email" required>
      </div>

      <div class="buttonWrapper">
        <button type="submit" id="submitButton" name="r_btn" class="submitButton pure-button pure-button-primary">
          <span>Continue</span>
          <span id="loader"></span>
        </button>
      </div>

    </form>
  </div>
</div>
<script>
  // document.getElementById('signupLogo').src = "https://s3-us-west-2.amazonaws.com/shipsy-public-assets/shipsy/SHIPSY_LOGO_BIRD_BLUE.png";
  enableSubmitButton();

  function enableSubmitButton() {
    document.getElementById('submitButton').disabled = false;
    document.getElementById('loader').style.display = 'none';
  }

  function disableSubmitButton() {
    document.getElementById('submitButton').disabled = true;
    document.getElementById('loader').style.display = 'unset';
  }

  // signupForm.addEventListener('submit',(e)=>{
  //   e.preventDefault();
  // });
</script>