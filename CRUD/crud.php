<?php
class Crud {
   public $connect;
   private $host = "localhost";
   private $username = "root";
   private $password = "";
   private $database = "crud_table";
    
   function __construct(){
       
       $this->databaseConnect();
   }
   
   public function databaseConnect(){
       
       $this->connect = new mysqli($this->host, $this->username, $this->password, $this->database);
   }
   
   public function executeQuery($sql){
    
       return $result = $this->connect->query($sql);
   }
   
   public function getDataFromTable($sql){
       
       $result = $this->executeQuery($sql);
       echo '
            <table class="table table-bordered table-striped">
                <tr>
                    <th width = "10%" class="text-center">Zdjęcie</th>
                    <th width = "35%" class="text-center">Imię</th>
                    <th width = "35%" class="text-center">Nazwisko</th>
                    <th width = "10%" class="text-center">Aktualizuj</th>
                    <th width = "10%" class="text-center">Usuń</th>
                </tr>';
       
       while($row = mysqli_fetch_object($result)){
           echo'
                <tr>
                    <td><img src="uploads/'.$row->image.'" width="50" height="35" /></td>
                    <td>'.$row->first_name.'</td>
                    <td>'.$row->last_name.'</td>
                    <td><button type="button" name="update" id="'.$row->id.'" class="btn btn-success btn-xs update">Aktualizuj</button></td>
                    <td><button type="button" name="delete" id="'.$row->id.'" class="btn btn-danger btn-xs delete delete">Usuń</button></td>
                </tr>';
       }
       echo '</table>';     
   }
   
   function uploadFile($file){
       if(isset($file)){
           
           $destination = './uploads/'. $file['name'];
           move_uploaded_file($file['tmp_name'], $destination);
           return $file['name'];
       }
   }
}