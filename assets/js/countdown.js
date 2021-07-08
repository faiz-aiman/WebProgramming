/*
 * Basic Count Down to Date and Time
 * Author: @guwii / guwii.com
 * https://guwii.com/bytes/easy-countdown-to-date-with-javascript-jquery/
*/
window.onload = function() {
    // Month Day, Year Hour:Minute:Second, id-of-element-container
    countDownToTime("Jan 5, 2022 15:00:00", 'countdown1'); // ****** Change this line!
}
function countDownToTime(countTo, id) {
countTo = new Date(countTo).getTime();
var now = new Date(),
    countTo = new Date(countTo),
    timeDifference = (countTo - now);
    
var secondsInADay = 60 * 60 * 1000 * 24,
    secondsInAHour = 60 * 60 * 1000;

days = Math.floor(timeDifference / (secondsInADay) * 1);
hours = Math.floor((timeDifference % (secondsInADay)) / (secondsInAHour) * 1);
mins = Math.floor(((timeDifference % (secondsInADay)) % (secondsInAHour)) / (60 * 1000) * 1);
secs = Math.floor((((timeDifference % (secondsInADay)) % (secondsInAHour)) % (60 * 1000)) / 1000 * 1);

var idEl = document.getElementById(id);
idEl.getElementsByClassName('days')[0].innerHTML = days;
idEl.getElementsByClassName('hours')[0].innerHTML = hours;
idEl.getElementsByClassName('minutes')[0].innerHTML = mins;
idEl.getElementsByClassName('seconds')[0].innerHTML = secs;

clearTimeout(countDownToTime.interval);
countDownToTime.interval = setTimeout(function(){ countDownToTime(countTo, id); },1000);
}