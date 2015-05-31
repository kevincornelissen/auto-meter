window.onload = function() {
    init();
};

var public_spreadsheet_url = 'https://docs.google.com/spreadsheets/d/1uLWWyKBCMjbKIZV8Jx9FDbStL4Nzja6Lvq8EK0h8vKY/pubhtml';

function init() {
    Tabletop.init({
        key: public_spreadsheet_url,
        callback: showInfo,
        simpleSheet: true
    });
}

function showInfo(data) {
    var totalKm = 0;

    var table = document.getElementById("total-table");
    for (var i = 0; i < data.length; i++) {
        var row = document.createElement("tr");
        table.appendChild(row);

        var destination = document.createElement("td");
        destination.innerHTML = data[i].Bestemming;
        row.appendChild(destination);

        var date = document.createElement("td");
        date.innerHTML = data[i].Datum;
        row.appendChild(date);

        var car = document.createElement("td");
        car.innerHTML = data[i].Auto;
        row.appendChild(car);

        var start = document.createElement("td");
        start.innerHTML = data[i].Begin_KM;
        row.appendChild(start);

        var end = document.createElement("td");
        end.innerHTML = data[i].Eind_KM;
        row.appendChild(end);

        var subtotal = document.createElement("td");
        subtotal.innerHTML = data[i].Eind_KM - data[i].Begin_KM;
        row.appendChild(subtotal);

        totalKm += Number(subtotal.innerHTML);

        // var discount = document.createElement("td");
        // if (data[i].Korting == "Lange afstand") {
        //     discount.innerHTML = "Ja";
        //     row.appendChild(discount);
        // } else {
        //     discount.innerHTML = "Nee";
        //     row.appendChild(discount);
        // }
    }

    var totalEuro = totalKm * 0.2;

    document.getElementById("total").innerHTML = "Totaal\: " + totalKm + " km / " + totalEuro + " \€";
}