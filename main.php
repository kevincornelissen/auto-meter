<?php
require 'functions.php';
require 'config.php';

$conn = connect($config);

$list = query('SELECT * FROM trips',$conn);

$totalEndKm = getValue('SELECT SUM(end_km) FROM trips', 'SUM(end_km)', $conn);
$totalBeginKm = getValue('SELECT SUM(begin_km) FROM trips', 'SUM(begin_km)', $conn);
$totalKm = $totalEndKm - $totalBeginKm;

$totalCountSaab = getValue("SELECT count(car) FROM trips where car like 'Saab'", 'count(car)', $conn);
$totalCountSharan = getValue("SELECT count(car) FROM trips where car like 'Sharan'", 'count(car)', $conn);

$totalBeginKmSaab = getValue("SELECT SUM(begin_km) FROM trips where car like 'Saab'", 'SUM(begin_km)', $conn);
$totalBeginKmSharan = getValue("SELECT SUM(begin_km) FROM trips where car like 'Sharan'", 'SUM(begin_km)', $conn);

$totalEndKmSaab = getValue("SELECT SUM(end_km) FROM trips where car like 'Saab'", 'SUM(end_km)', $conn);
$totalEndKmSharan = getValue("SELECT SUM(end_km) FROM trips where car like 'Sharan'", 'SUM(end_km)', $conn);

mysqli_close($conn);

$totalEuro = $totalKm * 0.2;

$totalKmSaab = $totalEndKmSaab - $totalBeginKmSaab;
$totalKmSharan = $totalEndKmSharan - $totalBeginKmSharan;

$saabPercentagePerRide = round($totalCountSaab / ($totalCountSaab + $totalCountSharan) * 100);
$sharanPercentagePerRide = round($totalCountSharan / ($totalCountSharan + $totalCountSaab) * 100);

$saabPercentagePerKm = round($totalKmSaab / $totalKm * 100);
$sharanPercentagePerKm = round($totalKmSharan / $totalKm * 100);

if ($saabPercentagePerKm < 1) {
	$saabPercentagePerKm = 1;
	$sharanPercentagePerKm = 99;
}

if ($sharanPercentagePerKm < 1) {
	$sharanPercentagePerKm = 1;
	$saabPercentagePerKm = 99;
}