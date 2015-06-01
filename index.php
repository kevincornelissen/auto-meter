<?php 
require 'functions.php';

$conn = connect($config);

$list = query('SELECT * FROM test',$conn);

$total = query('SELECT SUM(begin_km), SUM(end_km) FROM test',$conn);

if ($total->num_rows > 0) {
    while($row = $total->fetch_assoc()) {
        $totalKm = $row["SUM(end_km)"] - $row["SUM(begin_km)"];
    }
}

$totalEuro = $totalKm * 0.2;

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

$totalKmSaab = $totalEndKmSaabValue - $totalBeginKmSaabValue;
$totalKmSharan = $totalEndKmSharanValue - $totalBeginKmSharanValue;

$saabPercentagePerRide = round($totalCountSaabValue / ($totalCountSaabValue + $totalCountSharanValue) * 100);
$sharanPercentagePerRide = round($totalCountSharanValue / ($totalCountSharanValue + $totalCountSaabValue) * 100);

$saabPercentagePerKm = round($totalKmSaab / ($totalKmSaab + $totalKmSharan) * 100);
$sharanPercentagePerKm = round($totalKmSharan / ($totalKmSaab + $totalKmSharan) * 100);

if(isset($_POST['submit'])){
    $datum = $_POST['datum'];
    $bestemming = $_POST['bestemming'];
    $auto = $_POST['auto'];
    $beginKm = $_POST['begin-km'];
    $eindKm = $_POST['eind-km'];

    $sql = "INSERT INTO test (date, destination, car, begin_km, end_km)
    VALUES ('$datum', '$bestemming', '$auto', $beginKm, $eindKm)";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>
<!DOCTYPE>
<html>

<head>
    <title>kil-o-meter</title>
    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="img/favicon.png">
    <!-- google fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400' rel='stylesheet' type='text/css'>
    <!-- styleheets -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" style="float:right; margin: 10px;"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h2 id="total">
                <?= "Totaal: " . $totalKm . "km / €" . $totalEuro?>
                </h2>
                <div class="panel panel-default">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Bestemming</th>
                                <th>Datum</th>
                                <th>Auto</th>
                                <th>Begin Km</th>
                                <th>Eind Km</th>
                                <th>Totaal Km</th>
                                <!-- <th>Lange afstand</th> -->
                            </tr>
                        </thead>
                        <tbody id="total-table">
                        <?php 
                        if ($list->num_rows > 0) {
                            while($row = $list->fetch_assoc()) {
                                echo "<tr>";
                                    echo "<td>" . $row["destination"] . "</td>";
                                    echo "<td>" . $row["date"] . "</td>";
                                    echo "<td>" . $row["car"] . "</td>";
                                    echo "<td>" . $row["begin_km"] . "</td>";
                                    echo "<td>" . $row["end_km"] . "</td>";
                                    echo "<td>" . ($row["end_km"] - $row["begin_km"]) . "</td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <p id="bar-trip-title">Percentage/rit</p>
                <div class="progress" id="car-bar-trip">
                    <?= "<div id='saab-bar-trip' class='progress-bar' role='progressbar' aria-valuemin='0' aria-valuemax='100' aria-valuenow='" . $saabPercentagePerRide . "' style='width:" . $saabPercentagePerRide . "%;'>" . $saabPercentagePerRide . "%</div>" ?>
                    <?= "<div id='sharan-bar-trip' class='progress-bar' role='progressbar' aria-valuemin='0' aria-valuemax='100' aria-valuenow='" . $sharanPercentagePerRide . "' style='width:" . $sharanPercentagePerRide . "%;'>" . $sharanPercentagePerRide . "%</div>" ?>
                </div>
                <p id="bar-km-title">Percentage/km</p>
                <div class="progress" id="car-bar-km">
                    <?= "<div id='saab-bar-km' class='progress-bar' role='progressbar' aria-valuemin='0' aria-valuemax='100' aria-valuenow='" . $saabPercentagePerKm . "' style='width:" . $saabPercentagePerKm . "%;'>" . $saabPercentagePerKm . "%</div>" ?>
                    <?= "<div id='sharan-bar-km' class='progress-bar' role='progressbar' aria-valuemin='0' aria-valuemax='100' aria-valuenow='" . $sharanPercentagePerKm . "' style='width:" . $sharanPercentagePerKm . "%;'>" . $sharanPercentagePerKm . "%</div>" ?>
                </div>
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Nieuwe rit</h4>
                            </div>
                            <div class="modal-body">
                            <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
                            <div class="form-group">
                                <label for="bestemmingInput">Bestemming</label>
                                <input type="text" name="bestemming"class="form-control" id="bestemmingInput" placeholder="Vul bestemming in">
                            </div>
                            <div class="form-group">
                                <label for="datumInput">Datum</label>
                                <input type="text" name="datum" class="form-control" id="datumInput" placeholder="Vul datum in">
                            </div>
                            <div class="form-group">
                                <label for="autoInput">Auto</label>
                                <input type="text" name="auto" class="form-control" id="autoInput" placeholder="Vul auto in">
                            </div>

                            <div class="form-group">
                                <label for="beginInput">Begin Km</label>
                                <input type="text" name="begin-km" class="form-control" id="beginInput" placeholder="Vul begin km in">
                            </div>
                            <div class="form-group">
                                <label for="eindInput">Begin Km</label>
                                <input type="text" name="eind-km" class="form-control" id="eindInput" placeholder="Vul eind km in">
                            </div>
                            <button type="submit" name="submit" class="btn btn-default">Submit</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
</body>

</html>