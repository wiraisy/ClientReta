Date.prototype.addDays = function(days) {
    var date = new Date(this.valueOf());
    date.setDate(date.getDate() + days);
    return date;
}

var date = new Date();

var countDownDate = date.addDays(2).getTime();

// Update the count down every 1 second
var x = setInterval(function() {

    // Get today's date and time
    var now = new Date().getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    //   // Output the result in an element with id="demo"
    document.getElementById("countdown-section").innerHTML = days + "d " + hours + "h " +
        minutes + "m " + seconds + "s ";

    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("countdown-section").innerHTML = "EXPIRED";
    }
}, 1000);

var time = 30; // This is the time allowed
var saved_countdown = localStorage.getItem('saved_countdown');

if (saved_countdown == null) {
    // Set the time we're counting down to using the time allowed
    var new_countdown = new Date().getTime() + (time + 2) * 1000;

    time = new_countdown;
    localStorage.setItem('saved_countdown', new_countdown);
} else {
    time = saved_countdown;
}

// Update the count down every 1 second
var x = setInterval(() => {

    // Get today's date and time
    var now = new Date().getTime();

    // Find the distance between now and the allowed time
    var distance = time - now;

    // Time counter
    var counter = Math.floor((distance % (1000 * 60)) / 1000);

    // Output the result in an element with id="demo"
    document.getElementById("countdown-section").innerHTML = counter + " s";

    // If the count down is over, write some text 
    if (counter <= 0) {
        clearInterval(x);
        localStorage.removeItem('saved_countdown');
        document.getElementById("countdown-section").innerHTML = "EXPIRED";

    }
}, 1000);