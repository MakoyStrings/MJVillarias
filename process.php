<?php

session_start();
require_once 'includes/connection.php';

$update = false;
$fname="";
$lname="";

if(isset($_POST["save"])){
  $fname = $_POST["fname"];
  $lname = $_POST["lname"];

  $sql = "INSERT INTO person (first_name, last_name)
  VALUES ('$fname', '$lname')";

  if ($mysqli->open()->query($sql) === TRUE) {
    $_SESSION["message"] = " Succesfully added a reord";
    $_SESSION["alert_type"] = "bg_success";
  
  } else {
    echo "Error: " . $sql . "<br>" . $mysqli->close()->error;
  }

  header('location: index.php');
}

if(isset($_GET["delete"])){

  $id = $_GET["delete"];
  $sql = "DELETE FROM person WHERE id=$id";

  if ($mysqli->open()->query($sql) === TRUE) {
    $_SESSION["message"] = " Record has been deleted";
    $_SESSION["alert_type"] = "bg_danger";
  } else {
    echo "Error deleting record: " . $mysqli->close()->error;
  }

  header('location: index.php');
}


if(isset($_GET["edit"])){
  $id = $_GET["edit"];
  $sql = "SELECT * FROM person WHERE id=$id ";
  $result = $mysqli->open()->query($sql);
  $row = $result->fetch_assoc();
  $fname = $row["first_name"];
  $lname = $row["last_name"];
  $update = true;
}

if(isset($_POST["update"])){
  $id = $_POST["id"];
  $fname = $_POST["fname"];
  $lname = $_POST["lname"];
  $sql = "UPDATE person SET first_name='$fname', last_name='$lname' WHERE id=$id";

  if ($mysqli->open()->query($sql) === TRUE) {
    $_SESSION["message"] = " Record has been updated";
    $_SESSION["alert_type"] = "bg_warning";
  } else {
    echo "Error updating record: " .  $mysqli->close()->error;
  }

  header('location: index.php');
}

$mysqli->close();
?>