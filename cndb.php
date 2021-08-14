<?php
    $hostname = 'localhost:3306';
    $username = 'root';
    $password = '1927';
    $dbname = "member";
    $cookie_name = 'siteAuth';
    $cookie_time = (3600 * 24 * 30);
    $conn = mysqli_connect($hostname, $username, $password,$dbname);
    if (!$conn) {
        $hostname = 'localhost:3308';
        $username = 'root';
        $password = '';
        $dbname = "member";
        $conn = mysqli_connect($hostname, $username, $password,$dbname);
        if (!$conn) {
            die('Không thể kết nối: ');
            exit();
        }
        exit();
    }
