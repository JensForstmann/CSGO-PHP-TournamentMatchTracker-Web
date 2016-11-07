<?php

require('tmt-web.config.php');

$ip_port = explode(':', $_POST['ipport']);

$match_ini['token'] = $TMT_TOKEN;
$match_ini['map_pool'] = explode("\n", str_replace("\r", '', $_POST['map_pool']));
$match_ini['default_map'] = $_POST['default_map'];
$match_ini['match_id'] = rand(1, PHP_INT_MAX);
$match_ini['team1'] = ['id' => 1, 'name' => $_POST['team1name']];
$match_ini['team2'] = ['id' => 2, 'name' => $_POST['team2name']];
$match_ini['ip'] = $ip_port[0];
$match_ini['port'] = count($ip_port) > 1 ? $ip_port[1] : 0;
$match_ini['rcon'] = $_POST['rcon'];
$match_ini['pickmode'] = $_POST['pickmode'];
$match_ini['url'] = '';
$match_ini['match_end'] = $_POST['match_end'];
$match_ini['rcon_init'] = explode("\n", str_replace("\r", '', $_POST['rcon_init']));
$match_ini['rcon_config'] = explode("\n", str_replace("\r", '', $_POST['rcon_config']));
$match_ini['rcon_end'] = explode("\n", str_replace("\r", '', $_POST['rcon_end']));

$s = @stream_socket_client('tcp://' . $TMT_IP_PORT);

if ($s === false) {
    http_response_code(500);
    echo 'Error connecting to the TMT instance.';
    die();
}

fwrite($s, json_encode($match_ini));

$answer = '';

while (!feof($s)) {
    $answer .= fgets($s, 1024);
}

fclose($s);

if ($answer !== '') {
    http_response_code(400);
    echo utf8_encode($answer);
}
