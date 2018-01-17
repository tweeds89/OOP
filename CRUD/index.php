<?php

include 'crud.php';
$crud = new Crud();
?>
<html>
    <head> 
        <link rel="stylesheet" type="text/css" href="style.css"> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>  
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>
        <div class="box">
            <h2 align="center">Create Read Update Delete</h2>
            <button type="button" name="add" class="btn btn-success" data-toggle="collapse" data-target="#user_collapse">Dodaj</button>
            <br/> <br/>
            <div id="user_collapse" class="collapse"> 
            <form method="POST" id="user_form">
                <label>Podaj Imię:</label>
                <input type="text" name="first_name" id="first_name" class="form-control"/><br/>
                <label>Podaj nazwisko</label>
                <input type="text" name="last_name" id="last_name" class="form-control"/><br/>
                <label>Wybierz zdjęcie</label>
                <input type="file" name="user_image" id="user_image"/>
                <input type="hidden" name="hidden_user_image" id="hidden_user_image"/>
                <span id="uploaded_image"></span>
              <div align="center">
                <input type="hidden" name="action" id="action"/>
                <input type="hidden" name="user_id" id="user_id"/>
                <input type="submit" name="btn_action" id="btn_action" class="btn btn-default" value="Wstaw"/>
              </div>
            </form>
        </div>
            <div id="user_table"></div>
        </div>
    </body>
    <script>
      $(document).ready(function(){
       loadData();
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
                        $('#action').val('Insert');
                        $('#btn_action').val("Wstaw");
                        $('#uploaded_image').html('');
                    }
                });
            }else{
                alert('Wszystkie pola są wymagane');
            }
        });
        
        $(document).on('click', '.update', function(){         
            var user_id = $(this).attr("id");
            var action = "Fetch";
            $.ajax({
               url:"action.php",
               method:"POST",
               data:{user_id:user_id, action:action},
               dataType: "JSON",
               success:function(data){
                   $('.collapse').collapse("show");
                   $('#first_name').val(data.first_name);
                   $('#last_name').val(data.last_name);
                   $('#uploaded_image').html(data.image);
                   $('#hidden_user_image').val(data.user_image);
                   $('#btn_action').val("Zmień");
                   $('#action').val("Edit");
                   $('#user_id').val(user_id);
               }
            });           
        });
        
        $(document).on('click', '.delete', function(){
            var user_id = $(this).attr('id');
            var action = "Delete";
            if(confirm("Na pewno chcesz usunąć?")){
                $.ajax({
                    url:"action.php",
                    method:"POST",
                    data:{user_id:user_id, action:action},
                    success:function(data){
                        alert(data);
                        loadData();
                    }
                });
            }else{
                return false;
            }
        });
       });
    </script>
</html>

 
 

