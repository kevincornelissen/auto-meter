google.load('visualization', '1.0');

google.setOnLoadCallback(queryGoog);

function queryGoog() {
    var query = new google.visualization.Query('https://docs.google.com/spreadsheets/d/1aJDVTvGHy0DhdtPebzhlog_TCI-QaYrmJSJZj4uiH14/edit#gid=1441970223');

    query.setQuery('select H, C');

    query.send(handleQueryResponse);
}

function handleQueryResponse(response) {
    document.getElementById("total").innerHTML = "Totaal\: " + response.q.Lf[0].c[0].v;
    document.getElementById("date").innerHTML = response.q.Lf[1].c[1].f;



}