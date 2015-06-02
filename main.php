<?php
require 'functions.php';
require 'config.php';

$conn = connect($config);

$list = query('SELECT * FROM test',$conn);

$total = query('SELECT SUM(begin_km), SUM(end_km) FROM test',$conn);
if ($total->num_rows > 0) {
    while($row = $total->fetch_assoc()) {
        $totalKm = $row["SUM(end_km)"] - $row["SUM(begin_km)"];
    }
}

$totalCountSaab = query("SELECT count(car) FROM test where car like 'Saab'",$conn);
if ($totalCountSaab->num_rows > 0) {
    while($row = $totalCountSaab->fetch_array()) {
        $totalCountSaabValue = $row['count(car)'];
    }
}

$totalCountSharan = query("SELECT count(car) FROM test where car like 'Sharan'",$conn);
if ($totalCountSharan->num_rows > 0) {
    while($row = $totalCountSharan->fetch_array()) {
        $totalCountSharanValue = $row['count(car)'];
    }
}

$totalBeginKmSaab = query("SELECT SUM(begin_km) FROM test where car like 'Saab'",$conn);
if ($totalBeginKmSaab->num_rows > 0) {
    while($row = $totalBeginKmSaab->fetch_array()) {
        $totalBeginKmSaabValue = $row['SUM(begin_km)'];
    }
}

$totalEndKmSaab = query("SELECT SUM(end_km) FROM test where car like 'Saab'",$conn);
if ($totalEndKmSaab->num_rows > 0) {
    while($row = $totalEndKmSaab->fetch_array()) {
        $totalEndKmSaabValue = $row['SUM(end_km)'];
    }
}

$totalBeginKmSharan = query("SELECT SUM(begin_km) FROM test where car like 'Sharan'",$conn);
if ($totalBeginKmSharan->num_rows > 0) {
    while($row = $totalBeginKmSharan->fetch_array()) {
        $totalBeginKmSharanValue = $row['SUM(begin_km)'];
    }
}

$totalEndKmSharan = query("SELECT SUM(end_km) FROM test where car like 'Sharan'",$conn);
if ($totalEndKmSharan->num_rows > 0) {
    while($row = $totalEndKmSharan->fetch_array()) {
        $totalEndKmSharanValue = $row['SUM(end_km)'];
    }
}

$totalEuro = $totalKm * 0.2;

$totalKmSaab = $totalEndKmSaabValue - $totalBeginKmSaabValue;
$totalKmSharan = $totalEndKmSharanValue - $totalBeginKmSharanValue;

$saabPercentagePerRide = round($totalCountSaabValue / ($totalCountSaabValue + $totalCountSharanValue) * 100);
$sharanPercentagePerRide = round($totalCountSharanValue / ($totalCountSharanValue + $totalCountSaabValue) * 100);

$saabPercentagePerKm = round($totalKmSaab / ($totalKmSaab + $totalKmSharan) * 100);
$sharanPercentagePerKm = round($totalKmSharan / ($totalKmSaab + $totalKmSharan) * 100);

mysqli_close($conn);