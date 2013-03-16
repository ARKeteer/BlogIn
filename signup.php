<?php
  require_once('includes/recaptchalib.php');
  require_once('includes/UserClass.php');
  $privatekey = "6Lce-t0SAAAAAD3ar0uxPHqUlwwvOrT3NNLgoPUV";
  $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

  if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly
    die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
         "(reCAPTCHA said: " . $resp->error . ")");
  } else {
	$auth = new Auth();
	$result=$auth->createUser($_POST['name'],$_POST['email'],$_POST['password']);
	if($result) {
		header("Location: index.php?login=1");
		echo "Thanks for signing up!";
	}
  }
?>