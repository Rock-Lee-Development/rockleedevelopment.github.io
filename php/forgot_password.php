<?php

if(!isset($message)) {
  require_once("DBController.php");
  $db_handle = new DBController();
	$current_email = $_POST["emailForm"];
	$select_idquery= "SELECT UserID FROM User WHERE email='$current_email'";
	$current_id = $db_handle->getUserID($select_idquery);
  $query = "SELECT * FROM User WHERE email='$current_email'";
  $count = $db_handle->numRows($query);
  $token = $db_handle->generateNewString();

  if($count>0) {
    $updateToken= "UPDATE UserToken set Token = '$token' WHERE UserID='$current_id'";
    $result2 = $db_handle->updateQuery($updateToken);
    if(!empty($current_id)) {
      $actual_link = "http://localhost/public/my_site/GitHub/rock-lee-development.me/resetlink.php?UserID=$current_id &Token=$token";
      $toEmail = $current_email;
      $subject = "User Registration Activation Email";
      $content = "Click this link to activate your account. <a href='" . $actual_link . "'> </a>";
      $mailHeaders = "From: noreply@tourneyregistration.com\r\n";
      if(mail($toEmail, $subject, $content, $mailHeaders)) {
        echo "<script> alert('A link has been sent to your email adress.');
        window.location.href='../index.html'; </script>";
				exit;
      }
      unset($_POST);
    } else {
      $message = "Problem in registration. Try Again!";
    }
  }
   else
   {
    echo "<script> alert('The email address you entered is already associated with a user account');
    window.location.href='../index.html'; </script>";
		exit;
  }

}

if(!empty($message)) {
    if(isset($message)) echo $message;
}

if(!empty($error_message)) {
    if(isset($error_message)) echo $error_message;
}

?>
