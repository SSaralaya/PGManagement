<?php


?>
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

include('../vendor/autoload.php');
include('../dbmain_conn.php');

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;

if (isset($_POST["pass_reset"])) {
  if (isset($_GET["token"]) && isset($_GET["email"])) {
    $token = filter_input(INPUT_GET, "token", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_GET, "email", FILTER_SANITIZE_SPECIAL_CHARS);
    $new_pass = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    $confirm_pass = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_SPECIAL_CHARS);
    if (strlen($new_pass) >= 6 && strlen($confirm_pass) >= 6) {
      if ($new_pass === $confirm_pass) {
        $new_pass = md5($new_pass);
        if (!empty($token) && !empty($email)) {
          try {
            $decoded = (array) JWT::decode($token, new Key("1234", 'HS256'));
            if ($res = $maincon->query("SELECT * FROM tbloffice WHERE userid='" . $decoded["email"] . "' and verify_token='" . $decoded["verify_token"] . "'")) {
              if ($res->num_rows > 0) {
                $new_token = md5(rand()) . "exp";
                $row = $res->fetch_array();
                if ($maincon->query("UPDATE tbloffice SET verify_token='$new_token',pass='$new_pass' WHERE userid='" . $decoded["email"] . "' and verify_token='" . $decoded["verify_token"] . "'")) {
                  $_SESSION["class"] = "success";
                  $_SESSION["status"] = "Your new password has been reset successfully..";
                }
              } else {
                $_SESSION["class"] = "danger";
                $_SESSION["status"] = "Invalid token...";
              }
            }
          } catch (ExpiredException $e) {
            $_SESSION["class"] = "danger";
            $_SESSION["status"] = "Token expired...";
          } catch (Exception $e) {
            $_SESSION["class"] = "danger";
            $_SESSION["status"] = "Invalid token...";
          }
        } else {
          $_SESSION["class"] = "danger";
          $_SESSION["status"] = "Invalid token...";
        }
      } else {
        $_SESSION["class"] = "danger";
        $_SESSION["status"] = "Invalid token...";
      }
    } else {
      $_SESSION["class"] = "danger";
      $_SESSION["status"] = "Password length should be atleast 6...";
    }
  } else {
    $_SESSION["class"] = "danger";
    $_SESSION["status"] = "Password do not match...";
  }
}
?>
<?php
if (isset($_SESSION["status"])) {
  echo '<script>alert("'.$_SESSION["status"].'")</script>';
  unset($_SESSION["status"]);
  unset($_SESSION["class"]);
}
?>
<div class="mainDiv">
  <div class="cardStyle">
    <form method="post" name="signupForm" id="signupForm">

      <!-- <img src="" id="signupLogo"/> -->

      <h2 class="formTitle">
        Login to your account
      </h2>

      <div class="inputDiv">
        <label class="inputLabel" for="password">New Password</label>
        <input type="password" id="password" name="password" required>
      </div>

      <div class="inputDiv">
        <label class="inputLabel" for="confirmPassword">Confirm Password</label>
        <input type="password" id="confirmPassword" name="confirmPassword">
      </div>

      <div class="buttonWrapper">
        <button type="submit" id="submitButton" name="pass_reset" onclick="validateSignupForm()" class="submitButton pure-button pure-button-primary">
          <span>Continue</span>
          <span id="loader"></span>
        </button>
      </div>

    </form>
  </div>
</div>
<script>
  var password = document.getElementById("password"),
    confirm_password = document.getElementById("confirmPassword");

  // document.getElementById('signupLogo').src = "https://s3-us-west-2.amazonaws.com/shipsy-public-assets/shipsy/SHIPSY_LOGO_BIRD_BLUE.png";
  enableSubmitButton();

  function validatePassword() {
    if (password.value != confirm_password.value) {
      confirm_password.setCustomValidity("Passwords Don't Match");
      return false;
    } else {
      confirm_password.setCustomValidity('');
      return true;
    }
  }

  password.onchange = validatePassword;
  confirm_password.onkeyup = validatePassword;

  function enableSubmitButton() {
    document.getElementById('submitButton').disabled = false;
    document.getElementById('loader').style.display = 'none';
  }

  function disableSubmitButton() {
    document.getElementById('submitButton').disabled = true;
    document.getElementById('loader').style.display = 'unset';
  }

  function validateSignupForm() {
    var form = document.getElementById('signupForm');

    for (var i = 0; i < form.elements.length; i++) {
      if (form.elements[i].value === '' && form.elements[i].hasAttribute('required')) {
        console.log('There are some required fields!');
        return false;
      }
    }

    if (!validatePassword()) {
      return false;
    }

  }
</script>