<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>F.A.S.T - Termine</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="termin.css">
</head>
<body>
<div id="heading">
    <h1>Termine</h1>
</div>
<section id="content">
    <div class="contentSection">
        <div class="calenderDiv">
            <p class="left">Freie Termine:</p>
            <div class="calenderDivDiv">
                <div class="item calender">
                    <p class="oswald day">Mi</p>
                    <p class="time">08:00 &ndash; 11:30</p>
                    <p class="location">Praxis</p>
                    <p class="blue date">14.04</p>
                </div>
                <div class="item calender">
                    <p class="oswald day">Do</p>
                    <p class="time">10:00 &ndash; 11:00</p>
                    <p class="location">Event</p>
                    <p class="blue date">15.04</p>
                </div>
                <div class="item calender">
                    <p class="oswald day">Do</p>
                    <p class="time">15:00 &ndash; 16:30</p>
                    <p class="location">Praxis</p>
                    <p class="blue date">22.04</p>
                </div>
                <div class="item calender">
                    <p class="oswald day">Fr</p>
                    <p class="time">09:00 &ndash; 09:30</p>
                    <p class="location">Praxis</p>
                    <p class="blue date">23.04</p>
                </div>
                <div class="item calender">
                    <p class="oswald day">Di</p>
                    <p class="time">10:00 &ndash; 12:30</p>
                    <p class="location">Event</p>
                    <p class="blue date">27.04</p>
                </div>
            </div>
        </div>
        <div class="infoDiv">
            <p class="left">Info:</p>
            <p>
                Es gibt 3 verschiedene Arten von Terminen: <span class="blue">Events</span>,
                <span class="blue">Hausbesuche</span> und die Behandlung in der <span class="blue">Praxis</span>.
                <br><br>
                Events und die Behandlung in der Praxis sind über <span class="blue">Telefon</span>
                oder <span class="blue">Email</span> auszumachen.
                <br><br>
                Hausbesuche können nach telefonischer Absprache abgehalten werden.
            </p>
        </div>
        <div class="kontaktDiv">
            <form method="get" action="">
                <p class="left">Telefon:</p>
                <p><span class="blue">+43</span> 660 12345678</p>
                <p class="left">Email (keine Hausbesuche):</p>
                <div id="grid">
                    <label for="betreff">Betreff:</label>
                    <input type="text" name="betreff" id="betreff">
                    <label for="Termin">Termin:</label>
                    <input type="date" name="termin" id="termin">
                    <label for="nachricht">Nachricht:</label>
                    <input type="text" name="nachricht" id="nachricht" placeholder="Art der Behandlung...">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email">
                </div>
                <input type="submit" id="formButton" value="Email absenden">
            </form>
        </div>
    </div>
</section>
</body>
</html>