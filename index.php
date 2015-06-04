<?php require 'main.php'; ?>
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
                <h2 id="total">Totaal: <?= $totalKm ?> km/ € <?=$totalEuro?></h2>
                <div class="panel panel-default">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Datum</th>
                                <th>Bestemming</th>
                                <th>Auto</th>
                                <th>Begin Km</th>
                                <th>Eind Km</th>
                                <th>Totaal Km</th>
                            </tr>
                        </thead>
                        <tbody id="total-table">
                        <?php 
                        while($row = $list->fetch_assoc()) {
                            echo "<tr>";
                                echo "<td>" . $row["date"] . "</td>";
                                echo "<td>" . $row["destination"] . "</td>";
                                echo "<td>" . $row["car"] . "</td>";
                                echo "<td>" . $row["begin_km"] . "</td>";
                                echo "<td>" . $row["end_km"] . "</td>";
                                echo "<td>" . ($row["end_km"] - $row["begin_km"]) . "</td>";
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <p id="bar-trip-title">Percentage/rit</p>
                <div class="progress" id="car-bar-trip">
                    <div id='saab-bar-trip' class='progress-bar' role='progressbar' aria-valuemin='0' aria-valuemax='100' aria-valuenow='<?= $saabPercentagePerRide ?>' style='width:<?= $saabPercentagePerRide ?>%;'><?= $saabPercentagePerRide?>%</div>
                    <div id='sharan-bar-trip' class='progress-bar' role='progressbar' aria-valuemin='0' aria-valuemax='100' aria-valuenow='<?= $sharanPercentagePerRide ?>' style='width:<?= $sharanPercentagePerRide ?>%;'><?= $sharanPercentagePerRide?>%</div>
                </div>
                <p id="bar-km-title">Percentage/km</p>
                <div class="progress" id="car-bar-km">
                    <div id='saab-bar-km' class='progress-bar' role='progressbar' aria-valuemin='0' aria-valuemax='100' aria-valuenow='<?= $saabPercentagePerKm ?>' style='width:<?= $saabPercentagePerKm ?>%;'><?= $saabPercentagePerKm?>%</div>
                    <div id='sharan-bar-km' class='progress-bar' role='progressbar' aria-valuemin='0' aria-valuemax='100' aria-valuenow='<?= $sharanPercentagePerKm ?>' style='width:<?= $sharanPercentagePerKm ?>%;'><?= $sharanPercentagePerKm?>%</div>
                </div>
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="form-title">Nieuwe rit</h4>
                            </div>
                            <div class="modal-body">
                                <form name="addTrip" action="form.php" method="post" onsubmit="return validateForm()">
                                    <label>Auto</label>
                                    <div class="form-group">
                                        <label for="autoInputSaab" class="radio-inline">
                                            <input type="radio" name="auto" id="autoInputSaab" value="Saab"> Saab
                                        </label>
                                        <label for="autoInputSharan" class="radio-inline">
                                            <input type="radio" name="auto" id="autoInputSharan" value="Sharan"> Sharan
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="bestemmingInput">Bestemming</label>
                                        <input type="text" name="bestemming"class="form-control" id="bestemmingInput" placeholder="Vul bestemming in">
                                    </div>
                                    <div class="form-group">
                                        <label for="datumInput">Datum</label>
                                        <input type="text" name="datum" class="form-control" id="datumInput" placeholder="jjjj/mm/dd">
                                    </div>
                                    <div class="form-group">
                                        <label for="beginInput">Begin Km</label>
                                        <input type="text" name="begin-km" class="form-control" id="beginInput" placeholder="Vul begin km in">
                                    </div>
                                    <div class="form-group">
                                        <label for="eindInput">Eind Km</label>
                                        <input type="text" name="eind-km" class="form-control" id="eindInput" placeholder="Vul eind km in">
                                    </div>
                                    <div class="form-group">
                                        <label for="code">Code</label>
                                        <input type="password" name="code" class="form-control" id="code" placeholder="code">
                                    </div>
                                    <div class="form-group">
                                        <button id="submit-button" type="submit" name="submit" class="btn btn-primary btn-block">Verstuur</button>
                                    </div>
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
    <script src="js/form_validation.js" type="text/javascript"></script>
    <script src="js/main.js" type="text/javascript"></script>
</body>

</html>