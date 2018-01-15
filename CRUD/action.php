<?php
include 'crud.php';
$crud = new Crud();

if($_SERVER['REQUEST_METHOD']==="POST"){
  if($_POST['action'] == "Load"){
      $crud->getDataFromTable("SELECT * FROM users ORDER BY id DESC");
  }
  if($_POST['action'] == "Insert"){
    $first_name = mysqli_real_escape_string($crud->connect, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($crud->connect, $_POST['last_name']);
    $image = $crud->uploadFile($_FILES['user_image']);
    $query = "INSERT INTO users (first_name, last_name, image) VALUES ('$first_name', '$last_name', '$image')";
    
    $crud->executeQuery($query);   
  }
}

