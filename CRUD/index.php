<?php
include 'crud.php';
$crud = new Crud();
?>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">          
    </head>
    <body>
        <div class="box">
            <div id="user_table"></div>
        </div>
    </body>
    <script>
       $(document).ready(function(){
        function loadData(){
         
          $.ajax({
              url:"action.php",
              method:"POST",
              success: function(data){
                  $('#user_table').html(data);
              }
          });
        }
        loadData();
       });
    </script>
</html>

