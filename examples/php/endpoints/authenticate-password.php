<?php
define('E4_API_URL', 'https://test.engine4.io/token');
define('E4_API_USERNAME', '');
define('E4_API_PASSWORD', '');
define('E4_API_CLIENT_ID', '');
define('E4_API_GRANT_TYPE', 'password');

function authenticate($url, $username, $password, $grantType, $clientId)
{
    $data = [
        'client_id' => $clientId,
        'grant_type' => $grantType,
        'password' => $password,
        'username' => $username,
    ];
    $options = [
        'http' => [
            'method' => 'POST',
            'content' => htmlspecialchars_decode(http_build_query($data)),
        ],
    ];
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    return json_decode($result);
}

$result = authenticate(E4_API_URL, E4_API_USERNAME, E4_API_PASSWORD, E4_API_GRANT_TYPE, E4_API_CLIENT_ID);
var_dump($result)
?>
