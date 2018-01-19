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
  
  if($_POST['action'] == "Fetch"){
      $output = '';
      $query = "SELECT * FROM users WHERE id = '".$_POST['user_id']."'";
      $result = $crud->executeQuery($query);
      while($row = mysqli_fetch_array($result)){
          $output['first_name'] = $row['first_name'];
          $output['last_name'] = $row['last_name'];
          $output['user_image'] = $row['image'];
          //print_r($output);
          $output['image'] = '<img src="uploads/'.$row['image'].'" width="50" height="35"/>';       
      }
      echo json_encode($output);
  }
  
  if($_POST['action'] == "Edit"){
      $image = "";
      if($_FILES['user_image']['name'] !=''){
          $image = $crud->uploadFile($_FILES['user_image']);
      }else{
          $image = $_POST['hidden_user_image'];
      }
      $first_name = mysqli_real_escape_string($crud->connect, $_POST['first_name']);
      $last_name = mysqli_real_escape_string($crud->connect, $_POST['last_name']);
      
      $query = "UPDATE users SET first_name = '".$first_name."', last_name = '".$last_name."',
                image = '".$image."' WHERE id = '".$_POST['user_id']."'";
      
      $crud->executeQuery($query);
      echo 'Dane zostały zaktualizowane';            
      }
      
  if($_POST['action'] == "Delete"){
      $query = "DELETE FROM users WHERE id = '".$_POST['user_id']."'";
      $crud->executeQuery($query);
      echo "Dane zostały usunięte";
  }
  
  if($_POST['action'] == "Search"){
      $search = mysqli_real_escape_string($crud->connect, $_POST['search']);
      $query = "SELECT * FROM users WHERE first_name LIKE '%".$search."%' OR last_name LIKE '%".$search."%' ORDER BY id DESC";
      
      echo $crud->getDataFromTable($query);
  }
}

