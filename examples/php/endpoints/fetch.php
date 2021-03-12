<?php
define('E4_API_URL', 'https://test.engine4.io/webapi/external/fetch');
define('E4_ACCESS_TOKEN', '');
define('E4_ENTITY_ID', '');

function fetch($url, $token, $entityId)
{
    $data = [
        'EntityId' => $entityId,
        'Take' => 15,
        'Skip' => 0,
        'WithLongValues' => true,
        'Filter' => null,
        'Sortings' => [],
    ];
    $options = [
        'http' => [
            'method' => 'POST',
            'header' => 'Content-Type: application/json\r\n' .
            'Authorization: Bearer ' . $token,
            'content' => json_encode($data),
        ],
    ];
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    return json_decode($result);
}

$result = fetch(E4_API_URL, E4_ACCESS_TOKEN, E4_ENTITY_ID);
var_dump($result);
