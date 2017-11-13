<?php
/*
| -------------------------------------------------------------------
| WEBSITE
| -------------------------------------------------------------------
|
| Use this class when working with website related data.
| 
| Instantiate it only once (great solution is Singleton design pattern) 
| and call public parameters and methods across entire website.
|
| -------------------------------------------------------------------
*/
namespace phplibrary;

class Website{
    public $server      = array(
        'host' => '',
        'uri'  => '',
        'path' => '',
        'page' => '',
    );
    public $name;
    public $host;
    public $made;
    public $language    = 'EN';
    public $charset     = 'UTF-8';
    public $description = 'Simple website';
    public $keywords    = 'siple, website';
    
    private $head    = array();
    private $bottom  = array();
    private $images  = array(
        'icon' => 'assets/images/icon.png',
        'logo' => 'assets/images/logo.png',
    );
    private $creator = array(
        'name'    => 'Zlatan Stajić',
        'website' => 'https://www.zlatanstajic.com/',
    );
    private $calls   = array(
        'css' => array(
            'ordinary' => 'link',
            'custom'   => 'link-custom',
        ),
        'javascript' => array(
            'ordinary' => 'script',
            'custom'   => 'script-custom',
        ),
    );
    
    // -------------------------------------------------------------------------
    
    /**
    * Class constructor method
    *
    * @param Array $params
    */
    public function __construct($params)
    {
        $this->server['host'] = $_SERVER['HTTP_HOST'];
        $this->server['uri']  = $_SERVER['REQUEST_URI'];
        $this->server['path'] = dirname($_SERVER['PHP_SELF']);
        $this->server['page'] = basename($_SERVER['PHP_SELF']);
        
        $this->name = $params['name'];
        $this->host = $params['host'];
        $this->made = $params['made'];
        
        empty($params['language']) ? NULL : $this->language = $params['language'];
        empty($params['charset']) ? NULL : $this->charset = $params['charset'];
        empty($params['description']) ? NULL : $this->charset = $params['description'];
        empty($params['keywords']) ? NULL : $this->charset = $params['keywords'];
    }        
    
    // -------------------------------------------------------------------------
    
    /**
    * Adding css and javascript tags to head of html
    * 
    * @param Array $params
    * 
    * @return void
    */
    public function add_to_head($params)
    {
        $this->head = $params;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Adding css and javascript tags to bottom of html
    * 
    * @param Array $params
    * 
    * @return void
    */
    public function add_to_bottom($params)
    {
        $this->bottom = $params;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Adding images to website
    * 
    * @param Array $params
    * @param Bool $to_merge
    * 
    * @return void
    */
    public function add_to_images($params, $to_merge=FALSE)
    {
        if($to_merge)
        {
            $this->images = array_merge($this->images, $params);
        }
        else
        {
            $this->images = $params;
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Adding data about website creator
    * 
    * @param Array $params
    * @param Bool $to_merge
    * 
    * @return void
    */
    public function add_to_creator($params, $to_merge=FALSE)
    {
        if($to_merge)
        {
            $this->creator = array_merge($this->creator, $params);
        }
        else
        {
            $this->creator = $params;
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Prints meta tags
    * 
    * If no title was given, prints website name
    * 
    * @param Array $params
    * 
    * @return String $meta
    */
    public function meta($params=array())
    {
        $meta = '';
        
        isset($params['title']) ? $title = $params['title'] : $title = '';
        isset($params['shortcut_icon']) ? $shortcut_icon = $params['shortcut_icon'] : $shortcut_icon = $this->images['icon'];
        isset($params['touch_icon']) ? $touch_icon = $params['touch_icon'] : $touch_icon = $this->images['icon'];
        isset($params['google_site_verification']) ? $meta .= '<meta name="google-site-verification" content="' . $params['google_site_verification'] . '"/>' . PHP_EOL : NULL;
        
        $touch_icon_size = $this->image_size($touch_icon);
                
        $meta .= '<meta http-equiv="Content-Type" content="text/html; charset=' . $this->charset . '">' . PHP_EOL;
        $meta .= '<meta http-equiv="X-UA-Compatible" content="IE=edge">' . PHP_EOL;
        $meta .= '<meta name="viewport" content="width=device-width, initial-scale=1">' . PHP_EOL;
        $meta .= '<meta name="description" content="' . $this->description . '">' . PHP_EOL;
        $meta .= '<meta name="keywords" content="' . $this->keywords . '">' . PHP_EOL;
        $meta .= '<meta name="author" content="' . $this->creator['name'] . '">' . PHP_EOL;
		$meta .= '<meta name="apple-mobile-web-app-capable" content="yes"/>' .PHP_EOL;
        $meta .= '<link rel="apple-touch-icon" sizes="' . $touch_icon_size['width_height'] . '" href="' . $touch_icon . '"/>' . PHP_EOL;
        $meta .= '<link rel="shortcut icon" href="' . $shortcut_icon . '" type="image/png">' . PHP_EOL;
        
        $meta .= '<title>';
            if(empty($title))
            {
                $meta .= $this->name;
            }
            else
            {
                $meta .= $title;
            }
        $meta .= '</title>' . PHP_EOL;
        
        return $meta;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Printing values in head of html
    * 
    * @return String $return
    */
    public function head()
    {
        $return = '';
        
        $return .= '<!-- HEAD -->' . PHP_EOL;
        if(empty($this->head))
        {
            $return .= '<!-- NOT LOADED -->' . PHP_EOL;
        }
        else
        {
            foreach($this->head as $head)
            {
                switch($head['type'])
                {
                    case $this->calls['css']['ordinary']:
                        {
                            $return .= '<link rel="stylesheet" href="';
                            $return .= $head['path'];
                            $return .= '">' . PHP_EOL;
                        }
                    break; 
                    case $this->calls['javascript']['ordinary']:
                        {
                            $return .= '<script src="';
                            $return .= $head['path'];
                            $return .= '"></script>' . PHP_EOL;
                        }
                    break; 
                    case $this->calls['css']['custom']:
                        {
                            $return .= '<style>';
                            $return .= $head['path'];
                            $return .= '</style>' . PHP_EOL;
                        }
                    break; 
                    case $this->calls['javascript']['custom']:
                        {
                            $return .= '<script>';
                            $return .= $head['path'];
                            $return .= '</script>' . PHP_EOL;
                        }
                    break;    
                }    
            }
        }
        $return .= '<!-- /HEAD -->' . PHP_EOL;
        
        return $return;
    }   
    
    // -------------------------------------------------------------------------
    
    /**
    * Printing values in bottom of html
    * 
    * @return String $return
    */
    public function bottom()
    {
        $return = '';
        
        $return .= '<!-- BOTTOM -->' . PHP_EOL;
        if(empty($this->bottom))
        {
            $return .= '<!-- NOT LOADED -->' . PHP_EOL;
        }
        else
        {
            foreach($this->bottom as $bottom)
            {
                switch($bottom['type'])
                {
                    case $this->calls['css']['ordinary']:
                        {
                            $return .= '<link rel="stylesheet" href="';
                            $return .= $bottom['path'];
                            $return .= '">' . PHP_EOL;
                        }
                    break;
                    case $this->calls['javascript']['ordinary']:
                        {
                            $return .= '<script src="';
                            $return .= $bottom['path'];
                            $return .= '"></script>' . PHP_EOL;
                        }
                    break;
                    case $this->calls['css']['custom']:
                        {
                            $return .= '<style>';
                            $return .= $bottom['path'];
                            $return .= '</style>' . PHP_EOL;
                        }
                    break;
                    case $this->calls['javascript']['custom']:
                        {
                            $return .= '<script>';
                            $return .= $bottom['path'];
                            $return .= '</script>' . PHP_EOL;
                        }
                    break;
                }   
            }
        }
        $return .= '<!-- /BOTTOM -->' . PHP_EOL;
        
        return $return;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Printing images values
    * 
    * @param String $image
    * 
    * @return Array
    */
    public function images($image)
    {
        if(empty($image))
        {
            return FALSE;
        }
        else
        {
            return $this->images[$image];
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Printing image size value
    * 
    * @param String $image
    * 
    * @return Array
    */
    public function image_size($image)
    {
        if(empty($image))
        {
            return FALSE;
        }
        else
        {
            $image_size = getimagesize($image);
            
            $data = array(
                'width'         => $image_size[0],
                'height'        => $image_size[1],
                'width_height'  => $image_size[0] . 'x' . $image_size[1],
                'type'          => $image_size[2],
                'size'          => $image_size[3],
                'bits'          => $image_size['bits'],
                'mime'          => $image_size['mime'],
            );
            
            return $data;
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Footer signature of creator and year when it was made
    * 
    * When you want year span (eg. 2007-2017) set 
    * first method parameter as TRUE.
    * 
    * @param boolean $always_made_year
    * 
    * @return String $signature
    */
    public function signature($always_made_year=FALSE, $show_licence=FALSE)
    {
        $current_year = date('Y');
        
        if($current_year == $this->made || $always_made_year)
        {
            $since = $current_year;
        }
        else
        {
            $since = $this->made . '-' . $current_year;
        }
        
        if($show_licence)
        {
            $licence = ' | ' . ' All Rights Reserved';
        }
        else
        {
            $licence = '';
        }
        
        $signature =  'Copyright &#169; ' . $since . ' | <a href="' . $this->creator['website'] . '" target="_blank">' .  $this->creator['name'] . '</a>' . $licence;
        
        return $signature;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Adds html comment to page view-source
    * 
    * If language parameter is not passed to method, 
    * default website language comment will be shown.
    * 
    * @param String $language
    * 
    * @return String $signature_hidden
    */
    public function signature_hidden($language='')
    {
        empty($language) ? $language = $this->language : NULL;
        
        $signature_hidden = PHP_EOL . '<!-- ';
        switch($language)
        {
            case 'EN':
                {
                    $signature_hidden .= 'Proudly built by: ' . $this->creator['name'] . '; Find me on ' . $this->creator['website'];
                } break;
            default: $signature_hidden .= 'Ponosno izradio: ' . $this->creator['name'] . '; Pronadjite me na ' . $this->creator['website'];
        }
        $signature_hidden .=  ' -->' . PHP_EOL;
        
        return $signature_hidden;
    }   
        
    // -------------------------------------------------------------------------
    
    /**
    * Page redirection
    * 
    * IMPORTANT: Please note that this method works with headers
    * and that it modifies them. When you test this method be 
    * careful because browser might get confused by mixed headers data.
    * 
    * @param String $page
    * @param Bool $is_url
    * @param Bool $to_exit
    * 
    * @return void
    */
    public function redirect_to_page($page, $is_url=FALSE, $to_exit=TRUE)
    {
        $is_url ? $url = $page : $url = $this->host . $page;
        
        if(!headers_sent())
        {
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: ' . $url);
            header("Connection: close");
        }
        
        print '<html>';
        print '<head><title>Redirecting you...</title>';
        print '<meta http-equiv="Refresh" content="0;url=' . $url . '" />';
        print '</head>';
        print '<body onload="location.replace(\''.$url.'\')">';
        
        print 'You should be redirected to this URL:<br />';
        print "<a href=\"$url\">$url</a><br /><br />";

        print 'If you are not, please click on the link above.<br />';

        print '</body>';
        print '</html>';

        
        if($to_exit)
        {
            exit;
        }
    }
    
    // -------------------------------------------------------------------------
}
?>