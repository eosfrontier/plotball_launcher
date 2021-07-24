<?php

use frontier\ploball\database\Database_Connection;

require __DIR__ . './vendor/autoload.php';

$blaat = new Database_Connection();

$blaat->connect();
