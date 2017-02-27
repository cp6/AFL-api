<?php
include('simple_html_dom.php');
$html = file_get_html('http://www.afl.com.au/match-centre/jlt-community-series/2017/2/wce-v-fre');
$array = array('data' => array());
foreach($html->find('div[class=commentary-timestamp]') as $timeo) {
    $timestamp = $timeo;//timestamp
    $timestamp = $timestamp->plaintext;
    $timestamp = ltrim($timestamp);//trims qtr string Q2 10:28
    $qtr = substr($timestamp, 0, 2);//gets qtr: Q2
    $time = substr($timestamp, -5);//gets time from qtr: 10:28
    $connect = mysqli_connect("127.0.0.1", "username", "password", "rnd1");
    $sql = "INSERT INTO g1t (`full`, `qtr`,`time`) VALUES('$timestamp','$qtr','$time')";
    $res = mysqli_query($connect, $sql);
}
    foreach ($html->find('div[class=commentary-comment]') as $com) {
        $commentary = $com;//commentary
        $commentary = $commentary->plaintext;
        //$match = substr($commentary, strpos($commentary, 'for the '));
        $commentary = str_replace("BEHIND","Behind ",$commentary);
        $commentary = str_replace("GOAL","Goal ",$commentary);
        $commentary = ltrim($commentary);
        $commentary = rtrim($commentary);
        $connect = mysqli_connect("127.0.0.1", "username", "password", "rnd1");
        $sql = "INSERT INTO g1c (`coms`) VALUES('$commentary')";
        $res = mysqli_query($connect, $sql);
        mysqli_close($connect);
};
//SELECT g1t.time, g1c.coms FROM g1c INNER JOIN g1t ON g1c.id = g1t.id