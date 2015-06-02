<?php
require 'functions.php';
require 'config.php';

$conn = connect($config);

$list = query('SELECT * FROM test',$conn);

$totalEndKm = getValue('SELECT SUM(end_km) FROM test', 'SUM(end_km)', $conn);
$totalBeginKm = getValue('SELECT SUM(begin_km) FROM test', 'SUM(begin_km)', $conn);
$totalKm = $totalEndKm - $totalBeginKm;

$totalCountSaab = getValue("SELECT count(car) FROM test where car like 'Saab'", 'count(car)', $conn);
$totalCountSharan = getValue("SELECT count(car) FROM test where car like 'Sharan'", 'count(car)', $conn);

$totalBeginKmSaab = getValue("SELECT SUM(begin_km) FROM test where car like 'Saab'", 'SUM(begin_km)', $conn);
$totalBeginKmSharan = getValue("SELECT SUM(begin_km) FROM test where car like 'Sharan'", 'SUM(begin_km)', $conn);

$totalEndKmSaab = getValue("SELECT SUM(end_km) FROM test where car like 'Saab'", 'SUM(end_km)', $conn);
$totalEndKmSharan = getValue("SELECT SUM(end_km) FROM test where car like 'Sharan'", 'SUM(end_km)', $conn);

mysqli_close($conn);

$totalEuro = $totalKm * 0.2;

$totalKmSaab = $totalEndKmSaab - $totalBeginKmSaab;
$totalKmSharan = $totalEndKmSharan - $totalBeginKmSharan;

$saabPercentagePerRide = round($totalCountSaab / ($totalCountSaab + $totalCountSharan) * 100);
$sharanPercentagePerRide = round($totalCountSharan / ($totalCountSharan + $totalCountSaab) * 100);

$saabPercentagePerKm = round($totalKmSaab / $totalKm * 100);
$sharanPercentagePerKm = round($totalKmSharan / $totalKm * 100);