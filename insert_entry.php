<?php
           require_once 'config.php';
                if(isset($_POST)){
                    //echo $_POST['data'];
                    $name = $_POST['name'];
                    $designation = $_POST['designation'];
                    $branch = $_POST['branch'];
                  //  $image = $_FILES['image']['tmp_name'];
                    $eom = $_POST['eom'];
                    $doj = $_POST['doj'];
                    $description = $_POST['description'];
                    $stmt = $con->prepare("INSERT INTO eom_table(name,designation,branch,eom_times,description,doj) 
VALUES(?,?,?,?,?,?)");
                    $stmt->bind_param('ssssss',$name,$designation,$branch,$eom,$description,$doj);
                    if($stmt->execute()){
                        echo "<p class='text-success'>"."Record inserted successfully"."</p>";
                    }
                }else{
    echo "print this";}
            ?>