<!DOCTYPE html>
<html lang="en-US">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Raleway:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="/assets/css/reset.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <link rel="icon" href="https://img.icons8.com/dusk/50/000000/rocket--v1.png">
    <title><?= esc($title); ?></title>
</head>
<body>
    <div class="main">
        <h1 id="title">Next launch</h1>
        <div id="timer">
            <ul>
                <li><span id="days"></span>Days</li>
                <li><span id="hours"></span>Hours</li>
                <li><span id="minutes"></span>Minutes</li>
                <li><span id="seconds"></span>Seconds</li>
            </ul>
        </div>
        <p id="detail"></p>
    </div>

    <script>
        const second = 1000;
        const minute = second * 60;
        const hour = minute * 60;
        const day = hour * 24;

        let launchDate = new Date("<?= esc($date_launch); ?>");

        let timer = setInterval(function () {
            let today = new Date().getTime();
            let countdown = launchDate - today;

            document.getElementById("days").innerText = String(Math.floor(countdown / (day))).padStart(2, 0);
            document.getElementById("hours").innerText = String(Math.floor((countdown % (day)) / (hour))).padStart(2, 0);
            document.getElementById("minutes").innerText = String(Math.floor((countdown % (hour)) / (minute))).padStart(2, 0);
            document.getElementById("seconds").innerText = String(Math.floor((countdown % (minute)) / second)).padStart(2, 0);

            if (countdown < 0) {
                document.getElementById("headline").innerText = "Rocket Launched";
                clearInterval(timer);
            }
        });

        const options = { year: 'numeric', month: 'short', day: 'numeric' };
        document.getElementById("detail").innerHTML = launchDate.toLocaleTimeString("en-US", options);
    </script>
</body>
</html>