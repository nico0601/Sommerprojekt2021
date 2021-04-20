<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="headerStyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="event.css">

    <script src="nav.js" defer></script>
</head>
<body>

<header>
    <img class="logo" src="images/logo.png" alt="Logo">

    <div id="nav-expand-icon-container">
        <a id="nav-icon-link" href="javascript:void(0)">Open Navigation</a>
        <span class="material-icons icon nav-expand-icon">menu</span>
    </div>

    <div id="page-no-nav"></div>

    <nav class="nav-hidden">
        <div id="nav-close-icon-container">
            <a id="nav-icon-link" href="javascript:void(0)">Close Navigation</a>
            <span class="material-icons icon nav-expand-icon">close</span>
        </div>
        <div class="nav-element">
            <a class="nav-link" href="index.php"></a>
            <span class="material-icons icon">home</span>
            Home
        </div>
        <div class="nav-dropdown-element">
            <div class="nav-element">
                <a class="nav-link" href="index.php"></a>
                <span class="material-icons icon">more_horiz</span>
                Angebote
            </div>
            <div class="nav-dropdown">
                <div class="nav-element">
                    <a class="nav-link" href="index.php"></a>
                    Therapie
                </div>
                <div class="nav-element">
                    <a class="nav-link" href="index.php"></a>
                    Training
                </div>
                <div class="nav-element">
                    <a class="nav-link" href="index.php"></a>
                    Events
                </div>
            </div>
        </div>
        <div class="nav-element">
            <a class="nav-link" href="index.php"></a>
            <span class="material-icons icon">event</span>
            Termine
        </div>
        <div class="nav-dropdown-element">
            <div class="nav-element">
                <a class="nav-link" href="index.php"></a>
                <span class="material-icons icon">person</span>
                Über uns
            </div>
            <div class="nav-dropdown">
                <div class="nav-element">
                    <a class="nav-link" href="index.php"></a>
                    Team
                </div>
                <div class="nav-element">
                    <a class="nav-link" href="index.php"></a>
                    Kontakt
                </div>
            </div>
        </div>
    </nav>

</header>