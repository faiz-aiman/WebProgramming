// Time Picker

function starttime(selector) {
	var defaultstarttime = select.getElementById("timestart").value;
	document.getElementById("demo").innerHTML = defaultstarttime;
    var select = $(selector);
    var hours, minutes, ampm;
    for (var i = 0; i < 1440; i += 60) {
        hours = Math.floor(i / 60);
        minutes = i % 60;
        if (hours < 10) {
            hours = "0" + hours; // adding leading zero to minutes portion
        }
        if (minutes < 10) {
            minutes = "0" + minutes; // adding leading zero to minutes portion
        }
        //add the value to dropdownlist
        if (hours + ":" + minutes != defaultstarttime) {
            select.append(
                $("<option></option>")
                    .attr("value", hours)
                    .text(hours + ":" + minutes)
            );
        } else {
            select.append(
                $("<option selected></option>")
                    .attr("value", hours)
                    .text(hours + ":" + minutes)
            );
        }
    }
}

function endtime(selector) {
	var defaultendtime = document.getElementById("timeend").value;
    var select = $(selector);
    var hours, minutes, ampm;
    for (var i = 0; i < 1440; i += 60) {
        hours = Math.floor(i / 60);
        minutes = i % 60;
        if (hours < 10) {
            hours = "0" + hours; // adding leading zero to minutes portion
        }
        if (minutes < 10) {
            minutes = "0" + minutes; // adding leading zero to minutes portion
        }
        //add the value to dropdownlist
        if (hours + ":" + minutes != defaultendtime) {
            select.append(
                $("<option></option>")
                    .attr("value", hours)
                    .text(hours + ":" + minutes)
            );
        } else {
            select.append(
                $("<option selected></option>")
                    .attr("value", hours)
                    .text(hours + ":" + minutes)
            );
        }
    }
}
//Calling the function on pageload
window.onload = function (e) {
    starttime("#timestart");
    endtime("#timeend");
};

