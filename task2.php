<?php

$url_str = "https://www.somehost.com/test/index.html?param1=4&param2=3&param3=2&param4=1&param5=3";
$newUrl = '/test/index.html';

function formerUrl($url_str, $newUrl)
{

    $query = parse_url($url_str, PHP_URL_QUERY);
    parse_str($query, $output);

    asort($output);

    foreach ($output as $key => $item) {
        if ($item == 3) {
            unset($output[$key]);
        }
    }

    asort($output);

    $pos = strpos($url_str, '/', 10);

    $newStr = http_build_query($output, '', '&');

    return substr($url_str, 0, $pos) . '/?' . $newStr . '&url=' . urlencode($newUrl);

}

echo formerUrl($url_str, $newUrl);
