<?php
$connect = mysqli_connect("127.0.0.1", "username", "password", "rnd1");
$sql = "SELECT g1t.time, g1t.qtr, g1t.full, g1c.coms FROM g1c INNER JOIN g1t ON g1c.id = g1t.id";
$result = mysqli_query($connect,$sql);
while($row = $result->fetch_assoc()) {
    echo "". $row["qtr"]. "  ". $row["time"]. "      ". $row["coms"]."<br>";
}
mysqli_close($connect);


