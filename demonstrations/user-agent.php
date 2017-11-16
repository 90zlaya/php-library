<?php
/*
| -------------------------------------------------------------------
| USER AGENT
| -------------------------------------------------------------------
|
| Developing and testing User_Agent class
|
| -------------------------------------------------------------------
*/
include_once '../autoload.php';

phplibrary\Format::pre(phplibrary\User_Agent::list_browsers(), FALSE);
phplibrary\Format::pre(phplibrary\User_Agent::list_devices(), FALSE);

$user_agents = array(
    'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0_3 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A432 Safari/604.1',
    'Mozilla/5.0 (Linux; Android 7.0; SAMSUNG SM-J330F Build/NRD90M) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/6.2 Chrome/56.0.2924.87 Mobile Safari/537.36',
    'Mozilla/5.0 (Linux; Android 4.4.2; GT-N7100 Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.84 Mobile Safari/537.36',
    'Mozilla/5.0 (Linux; Android 5.1.1; SAMSUNG SM-G531F Build/LMY48B) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/3.3 Chrome/38.0.2125.102 Mobile Safari/537.36',
    'Mozilla/5.0 (Linux; Android 6.0.1; SM-G903F Build/MMB29K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.98 Mobile Safari/537.36',
    'Mozilla/5.0 (Linux; Android 6.0.1; SM-J510FN Build/MMB29M) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.84 Mobile Safari/537.36',
    'Mozilla/5.0 (Linux; Android 7.0; SAMSUNG SM-J730F Build/NRD90M) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/6.2 Chrome/56.0.2924.87 Mobile Safari/537.36',
    'Mozilla/5.0 (Linux; Android 7.0; SM-J330F Build/NRD90M) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.84 Mobile Safari/537.36',
    'Mozilla/5.0 (Linux; Android 7.1.1; SAMSUNG SM-N950F Build/NMF26X) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/6.0 Chrome/56.0.2924.87 Mobile Safari/537.36',
    'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36',
    'Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; rv:11.0) like Gecko',
    'Mozilla/5.0 (Windows NT 6.3; WOW64; Trident/7.0; rv:11.0) like Gecko',
    'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:55.0) Gecko/20100101 Firefox/55.0',
);

foreach ($user_agents as $agent)
{
    echo phplibrary\User_Agent::detect_browser($agent);
    echo '-';
    echo phplibrary\User_Agent::detect_device($agent);
    echo '-';
    echo phplibrary\User_Agent::is_mobile($agent) ? 'Mobile' : 'Not mobile';
    echo '<br/>';
}
