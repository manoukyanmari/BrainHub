<?php

header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");

require '../vendor/autoload.php';

define('TMP_DIR', __DIR__.'/../tmp/');

use BrainHub\Persistence\SlimConfig;

$app = SlimConfig::getApp();

include '../src/BrainHub/Controller/UserController.php';

$app->run();