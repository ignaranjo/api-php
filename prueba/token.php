<?php
header('Access-Control-Allow-Origin: *');
header('Authorization: Bearer token');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header('Content-Type: text/html; charset=UTF-8');
header('Content-Type: application/json');
header("Content-Type: application/x-www-form-urlencoded");


function validarBerarToken()
{
    define('Bearer', 'Bearer 5dfa8ba01b5bde00019152fa328d1a3902e0462e8afa32c90efcc7b6');
    define('ADMIN_PASSWORD', 'mypass'); // Could be hashed too.
    $headers = getallheaders();
    $Authorization = $headers['Authorization'];

    if (
        !isset($headers['Authorization']) || ($headers['Authorization'] != Bearer)
    ) {
        header('HTTP/1.1 401 Unauthorized');
        header('WWW-Authenticate: Basic realm="Password For Blog"');
        exit("Access Denied: error Authorization. Bearer");
    }
}
