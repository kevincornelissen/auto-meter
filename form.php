<?php
require 'functions.php';
require 'config.php';

if(isset($_POST['submit'])){
    $datum = $_POST['datum'];
    $bestemming = $_POST['bestemming'];
    $auto = $_POST['auto'];
    $beginKm = $_POST['begin-km'];
    $eindKm = $_POST['eind-km'];

    $sql = "INSERT INTO trips (date, destination, car, begin_km, end_km)
    VALUES ('$datum', '$bestemming', '$auto', $beginKm, $eindKm)";

    $conn = connect($config);

    if ($conn->query($sql) === TRUE) {
        if(isset($_SERVER['HTTP_REFERER'])){
            header("Location: {$_SERVER['HTTP_REFERER']}");
        }
        else{
            header('Location: index.php');
        }
        mysqli_close($conn);
    }
}