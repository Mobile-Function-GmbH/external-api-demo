<?php
define('E4_API_URL', 'https://test.engine4.io/webapi/external/saveAll');
define('E4_ACCESS_TOKEN', '');
define('E4_ENTITY_ID', '');

function createGuid()
{
    return strtolower(sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535)));
}

function saveAll($url, $token, $items)
{
    $data = [
        'items' => $items,
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

$items = [
    [
        'EntityId' => E4_ENTITY_ID,
        'DataId' => createGuid(),
        'UserId' => '',
        'Custom_001' => 'Test1',
    ],
];

$result = saveAll(E4_API_URL, E4_ACCESS_TOKEN, $items);
var_dump($result);
