function validateForm() {
    var bestemming = $("#bestemmingInput").val(),
    	datum = $("#datumInput").val(),
    	auto = $("#autoInput").val(),
    	beginKm = $("#beginInput").val(),
    	eindKm = $("#eindInput").val(),
    	code = $("#code").val(),
    	status = true;

    $("#bestemmingInput").parent().removeClass("has-error");
    bestemming = $.trim(bestemming);
    if(!bestemming.match(/^[a-zA-Z]+$/)){
    	$("#bestemmingInput").parent().addClass("has-error");
    	if (status!= false){ status = false};
    }

    $("#datumInput").parent().removeClass("has-error");
    datum = $.trim(datum);
    datum.replace("/","-");
    if(!datum.match(/^(19|20)\d\d[- \/.](0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])$/)){
    	$("#datumInput").parent().addClass("has-error");
    	if (status!= false){ status = false};
    }

    $("#autoInput").parent().removeClass("has-error");
	auto = $.trim(auto);
    if(auto != "Saab" && auto != "Sharan"){
    	$("#autoInput").parent().addClass("has-error");
    	if (status!= false){ status = false};
    }

    $("#beginInput").parent().removeClass("has-error");
    beginKm = $.trim(beginKm);
    if(!beginKm.match(/^[0-9]{1,6}$/)){
    	$("#beginInput").parent().addClass("has-error");
    	if (status!= false){ status = false};
    }

    eindKm = $.trim(eindKm);
    $("#eindInput").parent().removeClass("has-error");
    if(!eindKm.match(/^[0-9]{1,6}$/)){
    	$("#eindInput").parent().addClass("has-error");
    	if (status!= false){ status = false};
    }

    $("#code").parent().removeClass("has-error");
    if(code != "wachtwoord"){
    	$("#code").parent().addClass("has-error");
    	if (status!= false){ status = false};
    }
    return status;
}