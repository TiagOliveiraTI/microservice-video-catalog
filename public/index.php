<?php

use Core\Welcome;

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

var_dump ((new Welcome)->sayHello());