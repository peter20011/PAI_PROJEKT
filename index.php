<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('index', 'DefaultController');
Routing::get('chooseBandOrUser', 'DefaultController');


Routing::get('homePage', 'BBController');
Routing::get('bandProfile','BBController');



Routing::post('login',"SecurityController");
Routing::post('registrationBand',"SecurityController");
Routing::post('registrationUser',"SecurityController");
Routing::post('bandDescribe',"SecurityController");
Routing::post('changePassword',"SecurityController");

Routing::run($path);

