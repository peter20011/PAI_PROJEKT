<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>BOOKBAND - PASSWORD PAGE</title>
        <link rel="stylesheet" type="text/css" href="public/css/stylechangePassword.css">
    </head>
    <body>
            <div id="Page_topbar">
                <img class="Logo-small" src="public/img/logo.svg">
            </div>
            <div id="container">
                    <div id="root">
                        <div class="PageContainer">
                            <section class="Login-section">
                                <section class="ContainerBox">
                                    <h1 class="Login-Title">Change password</h1>
                                    <form class="Login-form" action="changePassword" method="POST">
                                        <div class="Input-container">
                                            <input class="Input_input" type="text" name="old_pass" placeholder="Old password" required="">
                                        </div>
                                        <div class="Input-container">
                                            <input class="Input_input" type="text" name="new_pass" placeholder="New password" required="">
                                        </div>
                                        <div class="Input-container">
                                            <input class="Input_input" type="text" name="new_pass2" placeholder="New password" required="">
                                        </div>
                                        <div class="Login-formOptions">
                                            <button class="ButtonConfirm" type="action">
                                                CONFIRM
                                            </button>
                                            <div class="Login-optionlink">
                                                <a href="homePage">Homepage</a>
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