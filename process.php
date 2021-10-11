<?php
error_reporting(E_ERROR | E_PARSE);

session_start();


$mysqli = new mysqli('127.0.0.1','dustin','Dustin12@','crud');

$id = 0;
$update = false;
$name = "";
$location = "";


if (isset($_POST['save'])){
   $name = $_POST['name'];
   $location = $_POST['location'];


   $mysqli->query("INSERT INTO data (name, location) VALUES('$name', '$location')");

   $_SESSION['message'] = "Record has been save!";
   $_SESSION['msg_type'] = "success";

   header("location: index.php");
}

if (isset($_GET['delete'])){
   $id = $_GET['delete'];
   $mysqli->query("DELETE FROM data WHERE id=$id");

   $_SESSION['message'] = "Record has been deleted!";
   $_SESSION['msg_type'] = "danger";

   header("location: index.php");
}

if (isset($_GET['edit'])){
   $id = $_GET['edit'];
   $update = true;
   $result = $mysqli->query("SELECT * FROM data WHERE id=$id");
   if (count($result)==1){
      $row = $result->fetch_array();
      $name = $row['name'];
      $location = $row['location'];
   }
}

if (isset($_POST['update'])){
   $id = $_POST['id'];
   $name = $_POST['name'];
   $location = $_POST['location'];


   $mysqli->query("UPDATE data SET name='$name', location='$location' WHERE id=$id");

   $_SESSION['message'] = "Record has been updated!";
   $_SESSION['msg_type'] = 'warning';
   header("location: index.php");

}
