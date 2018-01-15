<?php
class Crud {
   public $connect;
   private $host = "localhost";
   private $username = "root";
   private $password = "coderslab";
   private $database = "crud_table";
    
   function __construct(){
       
       $this->databaseConnect();
   }
   
   public function databaseConnect(){
       
       $this->connect = mysqli_connect($this->host, $this->username, $this->password, $this->database);
   }
   
   public function executeQuery($query){
       return mysqli_query($this->connect, $query);
   }
   
   public function getDataFromTable($query){
       
       $result = $this->executeQuery($query);
       echo '
            <table>
                <tr>
                    <th width = "10%">Zdjęcie</th>
                    <th width = "35%">Imię</th>
                    <th width = "35%">Nazwisko</th>
                    <th width = "10%">Aktualizuj</th>
                    <th width = "10%">Usuń</th>
                </tr>';
       
       while($row = mysqli_fetch_object($result)){
           echo'
                <tr>
                    <td><img src="uploads/'.$row->image.'" width="50" height="35" /></td>
                    <td>'.$row->first_name.'</td>
                    <td>'.$row->last_name.'</td>
                    <td><button type="button" name="update" id="'.$row->id.'" class="update">Aktualizuj</button></td>
                    <td><button type="button" name="delete" id="'.$row->id.'" class="delete">Usuń</button></td>
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