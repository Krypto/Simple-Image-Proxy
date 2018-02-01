<?php

define('ROOT_DIR', dirname(__FILE__, 2));
require_once ROOT_DIR . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'functions.php';

if (!empty($_GET)) {
    print_r(decrypt_url($_GET['url']));
} else {
    echo 'Invalid information supplied';
}
