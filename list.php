<?php

require('tmt-web.config.php');

$s = @stream_socket_client('tcp://' . $TMT_IP_PORT);

if ($s === false) {
    http_response_code(500);
    echo 'Error connecting to the TMT instance.';
    die();
}

fwrite($s, '{"token": "' . $TMT_TOKEN . '","action": "status_request"}');
$answer = '';
while (!feof($s)) {
    $answer .= fgets($s, 1024);
}
fclose($s);

$data = json_decode($answer, true);

if ($data === null) {
    http_response_code(500);
    echo $answer;
    die();
}

echo '<thead>';
echo '<tr>';
echo '<th>id</th>';
echo '<th>status</th>';
echo '<th>map</th>';
echo '<th>team 1</th>';
echo '<th>team 2</th>';
echo '<th>score</th>';
echo '</tr>';
echo '</thead>';

foreach ($data['matches'] as $match) {
    echo '<tr>';
    echo '<td>' . $match['id'] . '</td>';
    echo '<td>' . $match['status'] . '</td>';
    echo '<td>' . $match['map'] . '</td>';
    echo '<td>' . $match['team1']['name'] . '</td>';
    echo '<td>' . $match['team2']['name'] . '</td>';
    echo '<td>' . $match['team1']['score'] . ' - ' . $match['team2']['score'] . '</td>';
    echo '</tr>';
}
