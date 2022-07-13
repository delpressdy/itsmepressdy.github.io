<!-- Add user -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">

<h4 class="modal-title" id="myModalLabel"><b>LOGIN</b></h4>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    
</div>
<div class="modal-body">
<div class="container-fluid">

<?php
session_start();
$host = "localhost";  
 $username = "root";  
 $password = "";  
 $database = "sfps_db";  
 $message = "";  
 try  
 {  
  
      $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);  
      $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
      if(isset($_POST["in"]))  
      {  
               if(empty($_POST["username"]) || empty($_POST["password"]))  
           {  
                $message = 'All fields are required';  
           }  
           else  
           {  
                $query = "SELECT * FROM student WHERE id_no = :username AND password = :password  " ;  
                $statement = $connect->prepare($query);
                $statement->execute( 
                     array(  
                          'username'     =>     $_POST["username"],  
                          'password'     =>     md5($_POST["password"])
                         
                     )  
                );  
                $count = $statement->rowCount();  
        

                if($count > 0)  
                {  
                  $_SESSION["username"] = $_POST["username"];  
                  header("location:student/index.php");                 
                }  
                else  
                {  
                     $message = 'Wrong Data';  
                }  
           }  
      }  
 }  
 catch(PDOException $error)  
 {  
      $message = $error->getMessage();  
 }  

?>

<form method="POST" >

	
<div class="row" >
<div class="col-lg-3">
<label class="control-label" style="position:relative; top:7px;">Username:</label>
</div>
<div class="col-lg-9">
<input type="text" class="form-control" name="username" required>
</div>
</div>
<div style="height:10px;"></div>


<div class="row">
<div class="col-lg-3">
<label class="control-label" style="position:relative; top:7px;">Password:</label>
</div>
<div class="col-lg-9">
<input type="password" class="form-control" name="password" required>
</div>
</div>
<div style="height:10px;"></div>
<?php  
                if(isset($message))  
                {  
                     echo '<center><label class="text-danger" style="background-color: black; width: 200px">'.$message.'</label></center>';  
                }  
                ?>  
</div> 
</div>
<div class="modal-footer">


<button type="submit" name="in" class="btn btn-outline-primary"style="font-size: 12px;">Log-in</a></button>

</form>


</div>
</div>
</div>
</div>

<!-- end modal -->
