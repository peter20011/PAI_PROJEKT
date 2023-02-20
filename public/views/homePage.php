<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Find the band you want">
        <meta name="keywords" content="band">
        <title>BOOKBAND - HONMEPAGE</title>
        <link rel="stylesheet" type="text/css" href="public/css/stylehomePage.css">
        <script type="text/javascript" src="public/js/logout.js" defer></script>
        <script type="text/javascript" src="public/js/search.js" defer></script>
    </head>
    <body>
        <div id="TopBar">
            <div id="User-profile">
                <div class="User-profile2" onclick="logout(this)">
                    <img class="User-profile-avatar" src="public/img/defaultAvatar.svg">
                    <span class="Logout">Logout</span>
                </div>
            </div>
        </div>
            <div class="Page-Title-Bar">
                <span>Homepage</span>
            </div>
            <div id="container-page">
                <div class="search-bar">
                    <input placeholder="search band">
                </div>
                <section class="band-display">
                                <?php foreach ($bands as $band): ?>
                                    <div class="home-blocks">
                                    <div class="Home-row-blocks">
                                        <div class="Home-null"></div>
                                        <a class="BAND"  href=<?='/bandProfile?id='.$band->getId();?>>
                                            <div class="BAND-choose">
                                                <img class="Band-icon" src="public/img/band.svg">
                                                <div class="name"> <?=$band->getUsername();?> </div>
                                            </div>
                                        </a>
                                            <div class="Home-null"></div>
                                    </div>
                                </div>
                <?php endforeach; ?>
                </section>
            <footer>
                <a class="ButtonChange" href="changePassword">
                    Change password
                </a>
            </footer>
    </body>
</html>



<template id="band-template">
    <div class="home-blocks">
        <div class="Home-row-blocks">
            <div class="Home-null"></div>
            <a class="BAND"  href=''>
                <div class="BAND-choose">
                    <img class="Band-icon" src="">
                    <div class="name"> Lorem ipsum</div>
                </div>
            </a>
            <div class="Home-null"></div>
        </div>
    </div>
</template>