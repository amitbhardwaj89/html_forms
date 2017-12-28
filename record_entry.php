<!Doctype html>
<?php require_once 'config.php';?>
<html>
<head>
    <title>
        SIEC EMPLOYEE OF THE MONTH
    </title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">

    <script src="bootstrap-datetimepicker/js/new_jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="bootstrap-datetimepicker/css/datetimepicker.css"/>
    <link rel="stylesheet" type="text/css" href="bootstrap-datetimepicker/css/datetimepicker-custom.css"/>

    <script src="bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
    <script src="bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-md-6">
        <form method="post" action="#"  enctype="multipart/form-data">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control name">
            </div>
            <div class="form-group">
                <label>Designation</label>
                <input type="text" name="designation" class="form-control designation">
            </div>
            <div class="form-group">
                <label>Branch</label>
                <input type="text" name="branch" class="form-control">
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="form-group">
                <label>How many times EOM?</label>
                <input type="text" name="eom" class="form-control">
            </div>
            <div class="form-group">
                <label>DOJ</label>
                <input type="text" name="doj" class="form-control" id="datetimepick">
                <script>
                    jQuery('#datetimepick').datetimepicker({
                        autoclose:true,
                        format: 'yyyy-mm-dd'
                    });
                </script>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Save" name="save" class="btn btn-primary">
            </div>
        </form>

            <script>/*
                function stoprefresh(){
                    event.preventDefault();
                    jQuery.ajax({
                        url:'insert_entry.php',
                        method:'POST',
                        data:   jQuery('form').serialize(),
                        success: function(data){
                            console.log(data);
                    },
                    error:function(){
                            console.log('error occur')
                    }});
                }
*/
            </script>
        </div></div>

    <div class="row">
        <div class="col-md-2">Search by Name</div>
        <div class="col-md-6">
            <form action="#" method="post" class="form-inline">
                <div class="form-group">
                    <input type="text" class="form-control" name="search_by_name">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Search" name="search">
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
        <table class="table table-bordered">
            <thead><th>S#</th>
            <th>Name</th>
            <th>Designation</th>
            <th>Deptt.</th>
            <th>Image</th>
            <th>EOM... times</th>
            <th>DOJ</th>
            <th></th></thead>

        <?php
// insert data
        if(isset($_POST['save'])){
            //echo $_POST['data'];
            $name = $_POST['name'];
            $designation = $_POST['designation'];
            $branch = $_POST['branch'];
            $img_name = $_FILES['image']['name'];
            $app_name = time().'_'.$img_name;
            $image = $_FILES['image']['tmp_name'];
            move_uploaded_file($image,'img/'.$app_name);
            $eom = $_POST['eom'];
            $doj = $_POST['doj'];
            $description = $_POST['description'];
            $stmt = $con->prepare("INSERT INTO eom_table(name,designation,branch,image,eom_times,description,doj) 
VALUES(?,?,?,?,?,?,?)");
            $stmt->bind_param('sssssss',$name,$designation,$branch,$app_name,$eom,$description,$doj);
            if($stmt->execute()){
                echo "<p class='text-success'>"."Record inserted successfully"."</p>";
            }
        }else{
            echo "print this";}
            //search data
        if(isset($_POST['search'])) {
            $search_name = $_POST['search_by_name'];

            $stmt = $con->prepare("SELECT * FROM college.eom_table where name='$search_name'");
            $stmt->execute();
            $rs = $stmt->get_result();
            $i = 1;
            while ($row = $rs->fetch_assoc()) {
                $description = $row['description'];
                $eom_times = $row['eom_times'];
                echo "<tr>";
                echo "<td>".$i."</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['designation'] . "</td>";
                echo "<td>" . $row['branch'] . "</td>";
                echo "<td>"."<img src='img/$row[image]' width='100' height='100'/>"."</td>";
                echo "<td>" . $row['eom_times'] . "</td>";
                echo "<td>" . $row['doj'] . "</td>";
                echo "<td>"."<a class='btn btn-primary' href='update_record.php?id=$row[id]'>"."Edit"."</a>"."</td>";
                echo "</tr>";
                $i++;
            }
        }
        ?> </table></div>
    </div>

</div>
</body>
</html>