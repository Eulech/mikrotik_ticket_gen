<?php
require_once('routeros_api.class.php');

$ip = '192.168.99.254';
$user = 'admin';
$password = 'Geulech@1234';

$code = $_GET['code'] ?? null;
$profile = $_GET['profile'] ?? null;

if (!$code || !$profile) {
    die("Paramètres manquants");
}

$API = new RouterosAPI();

if ($API->connect($ip, $user, $password)) {
    $API->write('/ip/hotspot/user/add', false);
    $API->write('=name=' . $code, false);
    $API->write('=password=' . $code, false);
    $API->write('=profile=' . $profile);
    $API->read();
    $API->disconnect();
    header("Location: http://192.168.99.254/login?voucher=$code");
    exit;
} else {
    die("Impossible de se connecter à MikroTik");
}
?>