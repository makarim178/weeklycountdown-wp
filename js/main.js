let lasttime = document.getElementById('get_time').innerHTML;

var countDownDate = new Date(lasttime).getTime();

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
      
    // Output the result in an element with id="day[Val/Title]"
    document.getElementById("dayVal").innerHTML = days.toLocaleString('en-US', {
        minimumIntegerDigits: 2,
        useGrouping: false
      });
    document.getElementById("dayTitle").innerHTML = "Day";
    
    // Output the result in an element with id="hrs[Val/Title]"
    document.getElementById("hrsVal").innerHTML = hours.toLocaleString('en-US', {
        minimumIntegerDigits: 2,
        useGrouping: false
      });
    document.getElementById("hrsTitle").innerHTML = "Hours";

    // Output the result in an element with id="min[Val/Title]"
    document.getElementById("minVal").innerHTML = minutes.toLocaleString('en-US', {
        minimumIntegerDigits: 2,
        useGrouping: false
      });;
    document.getElementById("minTitle").innerHTML = "Minutes";
    
    // Output the result in an element with id="sec[Val/Title]"
    document.getElementById("secVal").innerHTML = seconds.toLocaleString('en-US', {
        minimumIntegerDigits: 2,
        useGrouping: false
      });;
    document.getElementById("secTitle").innerHTML = "Seconds";

    if (distance < 0) {
      clearInterval(x);
    }
  }, 1000);



