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
    var countSaab = 0;
    var countSharan = 0;
    var countSaabKm = 0;
    var countSharanKm = 0;

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
        if (data[i].Auto == "Sharan") {
            countSharan++;
        } else if (data[i].Auto == "Saab") {
            countSaab++;
        }

        var start = document.createElement("td");
        start.innerHTML = data[i].Begin;
        row.appendChild(start);

        var end = document.createElement("td");
        end.innerHTML = data[i].Eind;
        row.appendChild(end);

        var subtotal = document.createElement("td");
        subtotal.innerHTML = data[i].Eind - data[i].Begin;
        row.appendChild(subtotal);

        totalKm += Number(subtotal.innerHTML);

        if (data[i].Auto == "Sharan") {
            countSharanKm += Number(subtotal.innerHTML);
        } else if (data[i].Auto == "Saab") {
            countSaabKm += Number(subtotal.innerHTML);
        }

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
    var percentageSaab = countSaab / (countSaab + countSharan) * 100;
    var percentageSharan = countSharan / (countSaab + countSharan) * 100;
    var percentageSaabKm = countSaabKm / (countSaabKm + countSharanKm) * 100;
    var percentageSharanKm = countSharanKm / (countSaabKm + countSharanKm) * 100;

    document.getElementById("total").innerHTML = "Totaal\: " + totalKm + " km / &euro; " + totalEuro;

    document.getElementById("saab-bar-trip").setAttribute("aria-valuenow", percentageSaab);
    document.getElementById("saab-bar-trip").style.width = percentageSaab + "%";
    document.getElementById("saab-bar-trip").innerHTML = Math.round(percentageSaab) + "% Saab";
    if (percentageSaab < 5) {
        document.getElementById("saab-bar-trip").innerHTML = "";
    }

    document.getElementById("sharan-bar-trip").setAttribute("aria-valuenow", percentageSharan);
    document.getElementById("sharan-bar-trip").style.width = percentageSharan + "%";
    document.getElementById("sharan-bar-trip").innerHTML = Math.round(percentageSharan) + "% Sharan";
    if (percentageSharan < 5) {
        document.getElementById("sharan-bar-trip").innerHTML = "";
    }

    document.getElementById("saab-bar-km").setAttribute("aria-valuenow", percentageSaabKm);
    document.getElementById("saab-bar-km").style.width = percentageSaabKm + "%";
    document.getElementById("saab-bar-km").innerHTML = Math.round(percentageSaabKm) + "% Saab";
    if (percentageSaabKm < 5) {
        document.getElementById("saab-bar-km").innerHTML = "";
    }

    document.getElementById("sharan-bar-km").setAttribute("aria-valuenow", percentageSharanKm);
    document.getElementById("sharan-bar-km").style.width = percentageSharanKm + "%";
    document.getElementById("sharan-bar-km").innerHTML = Math.round(percentageSharanKm) + "% Sharan";
    if (percentageSharanKm < 5) {
        document.getElementById("sharan-bar-km").innerHTML = "";
    }

    $("#car-bar-trip").removeClass("hidden");
    $("#car-bar-km").removeClass("hidden");
    $("#bar-trip-title").removeClass("hidden");
    $("#bar-km-title").removeClass("hidden");

}