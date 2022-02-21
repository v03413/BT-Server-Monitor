<?php
header('Content-type:application/json;charset=utf-8');

$panel = [
    [
        'name' => '',
        'api'  => '',
        'key'  => '',
    ],
];

$return = [];

foreach ($panel as $item) {
    $url      = $item['api'] . '/system?action=GetNetWork';
    $data     = [
        'request_token' => md5(time() . md5($item['key'])),
        'request_time'  => time(),
    ];
    $result   = HttpPostCookie($url, $data, 5);
    $result   = json_decode($result, true);
    $return[] = [
        'name'    => $item['name'],
        'network' => [
            'upTotal'   => $result['upTotal'],
            'downTotal' => $result['downTotal'],
            'up'        => $result['up'],
            'down'      => $result['down'],
        ],
        'cpu'     => $result['cpu'],
        'load'    => $result['load'],
        'mem'     => $result['mem'],
        'disk'    => $result['disk'],
        'system'  => [
            'name' => $result['system'],
            'time' => $result['time'],
        ]
    ];
}

exit(json_encode($return));

function HttpPostCookie($url, $data, $timeout = 10)
{
    $cookie_file = sys_get_temp_dir() . '/bt_cook_' . md5($url) . '.cookie';
    $ch          = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $output = curl_exec($ch);
    curl_close($ch);

    return $output;
}
