<?php
session_start();
//user id
//tournament id
if(!isset($message)) {
  require_once("DBController.php");
  $db_handle = new DBController();
  $email = $_SESSION["email"];
  $query = "SELECT UserID FROM User WHERE email='$email'";
$current_id = $db_handle->getUserID($query);

  //if it is a team game
if(!empty($_POST["TeamName"]))
{


    //check limit size
    $result = "SELECT COUNT(*) FROM TeamMembers WHERE TeamID = ".$_POST["teamName"];
    $row_count = $db_handle->numRows($result);

    $result = "SELECT TeamLimit FROM UserTournaments WHERE TournamentID =".$_POST["TMname"]."AND TeamID = ".$_POST["teamName"];
    $team_limit=$db_handle->getTeamLimit($result);

    if($team_limit>)//number of UserID rows in Teammbers table
    {

    $query = "INSERT INTO UserTournaments (TournamentID, UserID) VALUES
    ('" . $_POST["TMname"] . "', '$current_id')";
    $insideTable = $db_handle->insertQuery($query);
        //enroll into team
        $query ="INSERT INTO TeamMembers (TeamID,UserID) VALUES
        ('" . $_POST["teamName"] . "', '$current_id')";
        $insideTable = $db_handle->insertQuery($query);

        if(!empty($insideTable)){

          //check the user already in the tournament

            echo "<script> alert(\'You successfuly join the team\');
           window.location.href=\'../index.html\'; </script>";
        }
        else{
            echo "<script> alert('something wrong');
           window.location.href='../index.html'; </script>";
        }

    }
    else{
        echo "<script> alert(\'This team id full, choose another one\');
           window.location.href=\'../index.html\'; </script>";
    }


}else{
  $query = "SELECT UserID FROM User WHERE email='$email'";
$current_id = $db_handle->getUserID($query);
$query = "INSERT INTO UserTournaments (TournamentID, UserID) VALUES
('" . $_POST["TMname"] . "', '$current_id')";
$insideTable = $db_handle->insertQuery($query);
}

  echo "<script> alert('you successfuly join this tournament');
           window.location.href='../index.html'; </script>";



}else{
  echo "<script> alert('something wrong');
           window.location.href='../index.html'; </script>";
}
?>
