<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('index', 'DefaultController');
Routing::get('chooseBandOrUser', 'DefaultController');
Routing::get('homePage', 'BandsController');
Routing::get('bandProfile','BBController');
Routing::get('like','BBController');

Routing::post('search','BandsController');
Routing::post('logout',"SecurityController");
Routing::post('login',"SecurityController");
Routing::post('registrationBand',"SecurityController");
Routing::post('registrationUser',"SecurityController");
Routing::post('changePassword',"SecurityController");

Routing::run($path);

