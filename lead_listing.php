<form action="#" method="post">
    <input type="submit" value="Search" name="search"/><input type="submit" value="Export" name="export"/>
</form>

<table class="table table-bordered" width="50" border="1" cellpadding="2">
    <thead><th>S#</th>
    <th>Name</th>
    <th>Mobile</th>
    <th>Email.</th>
    <th>Country</th>
    <th>Branch</th>
    <th>Date</th></thead>
<?php
require_once 'config.php';
if(isset($_POST['search'])) {

    $stmt = $con->prepare("SELECT * FROM college.html_forms");
    $stmt->execute();
    $rs = $stmt->get_result();
    $i = 1;
    $num = $rs->num_rows;
    for($n=0;$n<$num;$n++){
        while ($row[$n] = $rs->fetch_assoc()) {
            for($j=0;$j<$num;$j++){
                $records = $row[$n];
            }
            // print_r($row[$n]);
           $_SESSION['rs'] = $records;
            // $record = $records;

            echo "<tr>";
            echo "<td>".$i."</td>";
            echo "<td>" . $row[$n]['name'] . "</td>";
            echo "<td>" . $row[$n]['mobile'] . "</td>";
            echo "<td>" . $row[$n]['email'] . "</td>";
            echo "<td>".$row[$n]['country']."</td>";
            echo "<td>" . $row[$n]['branch'] . "</td>";
            echo "<td>" . $row[$n]['date'] . "</td>";
            echo "</tr>";
            $i++;
            var_dump($_SESSION['rs']);
        }

    }

//    global $record;
//  $record = $records;
   // var_dump($records);

}

if(isset($_POST['export'])){
    $filename = $_POST['export'].".xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    exportfile($_SESSION);
}
    function exportfile($data){
        $heading = false;
        var_dump($data);
       /* if(!empty($data))
            foreach($data as $r) {
                if(!$heading) {
                    // display field/column names as a first row
                    echo implode("\t", array_keys($r)) . "\n";
                    $heading = true;
                }
                echo implode("\t", array_values($r)) . "\n";
            }*/
    }
?>
</table>