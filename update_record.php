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
            <a class="btn btn-primary" href="record_entry.php">Back</a>

            <form method="post" action="#" onsubmit="stoprefresh()">
                <?php
                if(!empty($_GET['id'])){
                    $id = $_GET['id'];
                    $stmt = $con->prepare("SELECT * FROM college.eom_table where id=$id");
                    $stmt->execute();
                    $rs = $stmt->get_result();

                    while ($row = $rs->fetch_assoc()) {?>

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control name" placeholder="<?=$row['name'];?>">
                </div>
                <div class="form-group">
                    <label>Designation</label>
                    <input type="text" name="designation" class="form-control designation" placeholder="<?=$row['designation'];?>">
                </div>
                <div class="form-group">
                    <label>Branch</label>
                    <input type="text" name="branch" class="form-control" placeholder="<?=$row['branch'];?>">
                </div>
                <div class="form-group">
                    <label>How many times EOM?</label>
                    <input type="text" name="eom" class="form-control" value="<?=$row['eom_times'];?>">
                </div>
                <div class="form-group">
                    <label>DOJ</label>
                    <input type="text" name="doj" class="form-control" id="datetimepick" placeholder="<?=$row['doj'];?>">
                    <script>
                        jQuery('#datetimepick').datetimepicker({
                            autoclose:true,
                            format: 'yyyy-mm-dd'
                        });
                    </script>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control"><?=$row['description'];?></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="Update" name="update" class="btn btn-primary">
                </div>
                <?php }}?>
            </form>

            <script>/*
                function stoprefresh(){
                    event.preventDefault();
                    jQuery.ajax({
                        url:'update_query.php',
                        method:'POST',
                        data:
                            jQuery('form').serialize(),

                        success: function(data){
                            console.log(data);
                        },
                        error:function(){
                            console.log('error occur')
                        }});
                }*/

            </script>
        </div></div></div></body>
</html>


<?php
           if(!empty($_GET['id'])){
               $id = $_GET['id'];
                if(!empty($_POST['update'])){
                    $eom = $_POST['eom'];
                     $description = $_POST['description'];
                    $stmt = $con->prepare("UPDATE eom_table set eom_times=?,description=? where id=?");
                    $stmt->bind_param('ssi',$eom,$description,$id);
                                  if($stmt->execute()){
                        echo "<p class='text-success'>"."Record updated successfully"."</p>";
                    }
                }else{
    echo "print this";}}
            ?>