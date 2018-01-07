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
use phplibrary\User_Agent as user_agent;
use phplibrary\Format as format;

format::pre(user_agent::list_browsers(), 0);
format::pre(user_agent::list_devices(), 0);
format::pre(user_agent::list_crawlers(), 0);

$user_agents = array(
    'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0_3 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A432 Safari/604.1',
    'Mozilla/5.0 (Linux; Android 7.0; SAMSUNG SM-J330F Build/NRD90M) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/6.2 Chrome/56.0.2924.87 Mobile Safari/537.36',
    'Mozilla/5.0 (Linux; Android 4.4.2; GT-N7100 Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.84 Mobile Safari/537.36',
    'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36',
    'Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; rv:11.0) like Gecko',
    'Mozilla/5.0 (Windows NT 6.3; WOW64; Trident/7.0; rv:11.0) like Gecko',
    'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:55.0) Gecko/20100101 Firefox/55.0',
    'Mozilla/5.0 (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)',
);

foreach ($user_agents as $agent)
{
    echo user_agent::detect_browser($agent);
    echo '-';
    echo user_agent::detect_device($agent);
    echo '-';
    echo user_agent::is_mobile($agent) ? 'Mobile' : 'Not mobile';
    echo '-';
    echo user_agent::is_crawler($agent) ? 'Crawler' : 'Real';
    echo '<br/>';
}
