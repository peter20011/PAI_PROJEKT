<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Find the band you want">
        <meta name="keywords" content="band">
        <title>BOOKBAND - BAND-Profile</title>
        <link rel="stylesheet"  type="text/css"  href="public/css/stylebandProfile.css">
        <script type="text/javascript" src="public/js/logout.js" defer></script>
        <script type="text/javascript" src="public/js/statistic.js" defer></script>
        <script type="text/javascript" src="public/js/delete.js" defer></script>
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
                <span><?php echo $band->getUsername();?> </span>
            </div>
            <div id="container-page">
                <div class="home-blocks">
                    <div class="Home-row-blocks">
                        <a class="BAND" href="<?php echo $band->getFanpageLink() ?>" target="_blank">
                            <div class="BAND-choose">
                                <img class="Band-icon" src="public/img/facebook.svg">
                                    Visit our fanpage
                            </div>
                        </a>
                        <a class="BAND"  href="<?php echo $band->getYtLink()?>" target="_blank">
                            <div class="BAND-choose">
                                <img class="Band-icon" src="public/img/yt.svg">
                                Check us on YT
                            </div>
                        </a>
                    </div>
                    <div class="Home-row-blocks">
                        <a class="BAND" href="<?php echo $band->getScheduleLink()?>" target="_blank">
                            <div class="BAND-choose">
                                <img class="Band-icon" src="public/img/calendar.svg" >
                                Check out our dates
                            </div>
                        </a>
                        <div class="BAND">
                            <div class="BAND-choose Like"  onclick="addLike(<?php echo $band->getId(); ?>)">
                                <img class="Band-icon" src="public/img/like.svg">
                                Like us
                                <div class="counter" style="font-size: 30px;" ><?php echo $band->getNumberLikes()?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="Band-describe">
                    <?php echo $band->getBandDescription()?>
                </div>
            </div>
            <footer>
                <a class="ButtonBack" href="homePage">
                    Back
                </a>
                <?php if($_SESSION['role']==1):?>
                <div class="ButtonDelate" onclick="deleteBand(<?php echo $band->getId(); ?>)" >
                    Delate account
                </div>
                <?php endif;?>
            </footer>
    </body>
</html>