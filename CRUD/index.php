<?php

include 'crud.php';
$crud = new Crud();
?>
<html>
    <head> 
        <link rel="stylesheet" type="text/css" href="style.css"> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>                  
    </head>
    <body>
        <div class="box">
            <h2>Wprowadzaj/usuwaj dane</h2>
            <button type="button" name="add" class="btn-add" id="btn-add">Dodaj</button>            
        <div class="insert_user" id="insert_user">
            <form method="POST" id="user_form">
                <label>Podaj Imię:</label>
                <input type="text" name="first_name" id="first_name"/><br/>
                <label>Podaj nazwisko</label>
                <input type="text" name="last_name" id="last_name"/><br/>
                <label>Wybierz zdjęcie</label>
                <input type="file" name="user_image" id="user_image"/>
              <div align="center">
                <input type="hidden" name="action" id="action"/>
                <input type="submit" name="btn_action" id="btn_action" value="Wstaw"/>
              </div>
            </form>
        </div>
        <div id="user_table"></div>
        </div>
    </body>
    <script>
       $(document).ready(function(){
           
        $('#btn-add').click(function(){
            $("#insert_user").show();          
        });  
        
        $('#action').val("Insert");
        function loadData(){
         var action = "Load";
          $.ajax({
              url:"action.php",
              method:"POST",
              data:{action:action},
              success: function(data){
                  $('#user_table').html(data);
              }
          });
        }
        loadData();
        
        $('#user_form').on('submit', function(event){
            event.preventDefault();
            var firstName = $('#first_name').val();  
            var lastName = $('#last_name').val();  
            var extension = $('#user_image').val().split('.').pop().toLowerCase(); 
            if(extension != ''){
                if(jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1){
                    alert('Zły format pliku');
                    $('#user_image').val('');
                    return false;
                }
            }
            if((firstName != '') && (lastName !='') && (extension != '')){
                $.ajax({
                    url:"action.php",
                    method:"POST",
                    data: new FormData(this),
                    contentType:false,
                    processData:false,
                    success:function(data){
                        alert('Dane zostały wprowadzone');
                        $('#user_form')[0].reset();
                        loadData();
                    }
                });
            }else{
                alert('Wszystkie pola są wymagane');
            }
        });
       });
    </script>
</html>

 
 

