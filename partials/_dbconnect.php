<?php
    //connect to the Database...
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database= "users";   //specifies...wee are using this db


    //create a connection...
    $conn = mysqli_connect($servername, $username, $password , $database);

    //die if connection was not successful...
    if(!$conn){
        die("sorry we fail to connect:" .mysqli_connect_error());  //it is used to handle critical error
    }
   
?>