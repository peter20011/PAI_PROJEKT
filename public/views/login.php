<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Find the band you want">
        <meta name="keywords" content="band">
        <title>BOOKBAND - LOGIN PAGE</title>
        <link rel="stylesheet" type="text/css" href="public/css/styleLogin.css">
    </head>
    <body>
            <div id="Page_topbar">
                <img class="Logo-small" src="public/img/logo.svg">
            </div>
            <div class="Page-Title-Bar">
                <span>Find the band you want!!!</span>
            </div>
            <div id="container">
                    <div id="root">
                        <div class="PageContainer">
                            <section class="Login-section">
                                <section class="ContainerBox">
                                    <h1 class="Login-Title">Log in</h1>
                                    <form class="Login-form" action="login" method="POST">
                                        <div class="messages">
                                            <?php
                                                if(isset($messages)){
                                                    foreach ($messages as $message){
                                                        echo $message;
                                                    }
                                                }
                                            ?>
                                        </div>
                                        <div class="Input-container">
                                            <input class="Input_input" type="text" name="email" placeholder="Email" >
                                        </div>
                                        <div class="Input-container">
                                            <input class="Input_input" type="password" name="password" placeholder="Password">
                                        </div>
                                        <label class="Login-checkBox">
                                            <input type="checkbox">
                                            <em>Show password?</em>
                                        </label>
                                        <div class="Login-formOptions">
                                            <button class="ButtonLogin" type="submit">
                                                Login
                                            </button>
                                            <div class="Login-optionlink">
                                                <a href="chooseBandOrUser" >Sign up</a>
                                            </div>
                                        </div>
                                    </form>
                                </section>
                                    <img class="Login-logo" src="public/img/logo.svg">
                            </section>
                        </div>
                    </div>
            </div>
    </body>
</html>