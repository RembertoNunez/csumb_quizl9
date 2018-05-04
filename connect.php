<?php

function getDBConnection() {
    // mysql://b1c87726155360:715e7895@us-cdbr-iron-east-04.cleardb.net/heroku_973dda0b7285aeb?reconnect=true
    //C9 db info
    $host = "us-cdbr-iron-east-04.cleardb.net";
    $dbName = "heroku_973dda0b7285aeb";
    $username = "b1c87726155360";
    $password = "715e7895";
    
    //when connecting from Heroku
    if  (strpos($_SERVER['HTTP_HOST'], 'herokuapp') !== false) {
        $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $host = $url["host"];
        $dbName = substr($url["path"], 1);
        $username = $url["user"];
        $password = $url["pass"];
    } 
    
    try {
        //Creates a database connection
        $dbConn = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
    
        // Setting Errorhandling to Exception
        $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    }
    catch (PDOException $e) {
       echo "Problems connecting to database!";
       exit();
    }
    
    
    return $dbConn;
}

?>