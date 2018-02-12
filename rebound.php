<?php session_start();
include_once 'auth.php';
include_once 'config.php';

if($_GET['code']){
    $auth = new Auth(CLIENT_ID, CLIENT_SECRET, REDIRECT_URI, LOGIN_URI);
    $auth->setCode($_GET['code']);
    $auth->tradeAuthForToken();
}