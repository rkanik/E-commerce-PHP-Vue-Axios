<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbName = 'fpro_web';

    try {

        $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully"; 

    }catch(PDOException $e){
        
        //echo "Connection failed: " . $e->getMessage();
    }
