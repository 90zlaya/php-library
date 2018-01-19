<?php
/**
* User_Agent
*
* Working with user agent related data
*
* @package      PHP Library
* @subpackage   phplibrary
* @category     System
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
namespace phplibrary;

/**
* Working with user agent related data
*/
class User_Agent {
	/**
    * List of browsers and signatures
    * 
    * @var Array
    */
    protected static $browsers = array(
        array(
            'name'      => 'Firefox',
            'signature' => array('Firefox'),
        ),
        array(
            'name'      => 'Chrome',
            'signature' => array('Chrome'),
        ),
        array(
            'name'      => 'Safari',
            'signature' => array('Safari'),
        ),
        array(
            'name'      => 'Opera',
            'signature' => array('OPR'),
        ),
        array(
            'name'      => 'Edge',
            'signature' => array('Edge'),
        ),
        array(
            'name'      => 'Explorer',
            'signature' => array('MSIE', 'Trident'),
        ),
    );
    
    // -------------------------------------------------------------------------
    
    /**
    * List of devices and signatures
    * 
    * @var Array
    */
    protected static $devices = array(
        array(
            'name'      => 'Windows',
            'signature' => array('Windows'),
        ),
        array(
            'name'      => 'Android',
            'signature' => array('Android'),
        ),
        array(
            'name'      => 'iPhone',
            'signature' => array('iPhone'),
        ),
    );
    
    // -------------------------------------------------------------------------
    
    /**
    * List of crawlers user agents
    * 
    * @var Array
    */
    protected static $crawlers = array(
        'Mozilla/5.0 (compatible; AhrefsBot/5.2; +http://ahrefs.com/robot/)',
        'Mozilla/5.0 (compatible; Baiduspider/2.0; +http://www.baidu.com/search/spider.html)',
        'Mozilla/5.0 (compatible; Google-Site-Verification/1.0)',
        'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
        'Mozilla/5.0 (compatible; GrapeshotCrawler/2.0; +http://www.grapeshot.co.uk/crawler.php)',
        'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +http://go.mail.ru/help/robots)',
        'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/Robots/2.0; +http://go.mail.ru/help/robots)',
        'Mozilla/5.0 (compatible; MJ12bot/v1.4.7; http://mj12bot.com/)',
        'Mozilla/5.0 (compatible; MJ12bot/v1.4.8; http://mj12bot.com/)',
        'Mozilla/5.0 (compatible; NetcraftSurveyAgent/1.0; +info@netcraft.com)',
        'Mozilla/5.0 (compatible; SeznamBot/3.2; +http://napoveda.seznam.cz/en/seznambot-intro/)',
        'Mozilla/5.0 (compatible; Uptimebot/1.0; +http://www.uptime.com/uptimebot)',
        'Mozilla/5.0 (compatible; Windows; U; Windows NT 6.2; en-US; rv:12.0) Gecko/20120403211507 Firefox/12.0',
        'Mozilla/5.0 (compatible; Yahoo! Slurp; http://help.yahoo.com/help/us/ysearch/slurp)',
        'Mozilla/5.0 (compatible; YandexBot/3.0; +http://yandex.com/bots)',
        'Mozilla/5.0 (compatible; YandexImages/3.0; +http://yandex.com/bots)',
        'Mozilla/5.0 (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)',
        'Mozilla/5.0 (compatible; ips-agent)',
        'SafeDNSBot (https://www.safedns.com/searchbot)',
        'Mozilla/5.0 zgrab/0.x',
        'Googlebot-Image/1.0',
        'Twitterbot/1.0',
        'bitlybot/3.0 (+http://bit.ly/)',
        'curl/7.54.0',
        'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)',
        'python-requests/2.18.4',
    );
    
    // -------------------------------------------------------------------------
    
    /**
    * Mobile regex
    * 
    * @var String
    */
    protected static $mobile_user_agent_one = '/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i';
    
    // -------------------------------------------------------------------------
    
    /**
    * Mobile regex
    * 
    * @var String
    */
    protected static $mobile_user_agent_two = '/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i';
	
    // -------------------------------------------------------------------------
    
    /**
    * List all browsers
    * 
    * @return Array
    */
    public static function list_browsers()
    {
        return self::$browsers;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * List all devices
    * 
    * @return Array
    */
    public static function list_devices()
    {
        return self::$devices;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * List all crawlers
    * 
    * @return Array
    */
    public static function list_crawlers()
    {
        return self::$crawlers;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Detects browser according to user agent
    * 
    * @param String $user_agent
    * @param String $name_when_no_match
    * 
    * @return String
    */
	public static function detect_browser($user_agent, $name_when_no_match='')
	{
		foreach (self::$browsers as $browser)
        {
            foreach ($browser['signature'] as $signature)
            {
                if (strpos($user_agent, $signature))
                {
                    return $browser['name'];
                }
            }
        }
        
        return $name_when_no_match;
	}
	
    // -------------------------------------------------------------------------
    
    /**
    * Detects device according to user agent
    * 
    * @param String $user_agent
    * @param String $name_when_no_match
    * 
    * @return String
    */
    public static function detect_device($user_agent, $name_when_no_match='')
    {
        foreach (self::$devices as $device)
        {
            foreach ($device['signature'] as $signature)
            {
                if (strpos($user_agent, $signature))
                {
                    return $device['name'];
                }
            }
        }
        
        return $name_when_no_match;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Determines if given user agent is from mobile device
    * 
    * @param String $user_agent
    * 
    * @return Bool
    */
	public static function is_mobile($user_agent)
    {
		if 
        (
            preg_match(self::$mobile_user_agent_one, $user_agent) || 
            preg_match(self::$mobile_user_agent_two, substr($user_agent, 0, 4))
        )
		{
			return TRUE;
		}
		
        return FALSE;
	}
    
    // -------------------------------------------------------------------------
    
    /**
    * Determines if given user agent is crawler or not
    * 
    * @param String $user_agent
    * 
    * @return Bool
    */
    public static function is_crawler($user_agent)
    {
        if (in_array($user_agent, self::$crawlers))
        {
            return TRUE;
        }
        
        return FALSE;
    }
    
    // -------------------------------------------------------------------------
}
?>