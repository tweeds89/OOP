<?php
include 'crud.php';
$crud = new Crud();
if($_SERVER['REQUEST_METHOD']==="POST"){
    
        echo $crud->getDataFromTable("SELECT * FROM users ORDER BY id DESC");
    
}
