<?php

    $database= new mysqli("localhost","root","","mindmend");
    if ($database->connect_error){
        die("Connection failed:  ".$database->connect_error);
    }

?>