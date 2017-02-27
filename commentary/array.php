<?php
$connect = mysqli_connect("127.0.0.1", "username", "password", "rnd1");
$sql = "SELECT g1t.time, g1t.qtr, g1t.full, g1c.coms FROM g1c INNER JOIN g1t ON g1c.id = g1t.id";
$result = mysqli_query($connect,$sql);
$array = array('data' => array());
while($row = $result->fetch_assoc()) {
    //echo "". $row["time"]. "      ". $row["coms"]."<br>";
    $array['data'][] = array ('qtr' => $row["qtr"],'time' => $row["time"],'fulltimestamp' => $row["full"],'coms' => $row["coms"]);
}
mysqli_close($connect);
//output array in json
header('Content-Type: application/json');
echo json_encode($array);
$encode = json_encode($array);
//file_put_contents("".$steamprofile_id.".json", $encode);
$fp = fopen('g1.json', "w");
fwrite($fp, $encode);
fclose($fp);