$(document).ready(function() {
	setDateFieldWithCurrentDate();
    removePercentageTextIfUnderFivePercent();
});


function setDateFieldWithCurrentDate() {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; 
    var yyyy = today.getFullYear();

    if (dd < 10) {
        dd = '0' + dd
    }

    if (mm < 10) {
        mm = '0' + mm
    }

    today = yyyy + '/' + mm + '/' + dd;

    $("#datumInput").val(today);
}

function removePercentageTextIfUnderFivePercent(){
    if ($('#sharan-bar-km').attr('aria-valuenow') < 5){
        $('#sharan-bar-km').html('');
    }
    if ($('#saab-bar-km').attr('aria-valuenow') < 5){
        $('#saab-bar-km').html('');
    }
}
