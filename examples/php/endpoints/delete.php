<?php
define('E4_API_URL', 'https://test.engine4.io/webapi/external/delete');
define('E4_ACCESS_TOKEN', '');
define('E4_ENTITY_ID', '');
define('E4_DATA_ID', '');

function delete($url, $token, $entityId, $dataId)
{
    $data = [
        'entityId' => $entityId,
        'dataId' => $dataId,
    ];
    $query = http_build_query($data);
    $url = $url . '?' . $query;
    $options = [
        'http' => [
            'method' => 'DELETE',
            'header' => 'Authorization: Bearer ' . $token,
        ],
    ];
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    return json_decode($result);
}

$result = delete(E4_API_URL, E4_ACCESS_TOKEN, E4_ENTITY_ID, E4_DATA_ID);
var_dump($result);
