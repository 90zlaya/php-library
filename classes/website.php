<?php
/**
* Use this class when working with website related data.
* 
* Instantiate it only once (great solution is Singleton design pattern) 
* and call public parameters and methods across entire website.
*/
class Website{
    public $name;
    public $host;
    public $made;
    
    public $language          = 'EN';
    public $charset           = 'UTF-8';
    public $description       = 'Simple website';
    public $keywords          = 'siple, website';
    public $favorite_icon     = 'assets/images/favorite_icon.png';
    public $logo_front        = 'assets/images/logo_front.png';
    public $logo_inside       = 'assets/images/logo_inside.png';
    public $creator           = '<a href="https://www.zlatanstajic.com/">Zlatan Stajic</a>';
    public $creator_name      = 'Zlatan Stajic';
    public $creator_website   = 'https://www.zlatanstajic.com/';
    
    protected $head          = array();
    protected $bottom        = array();
    protected $link          = 'link';
    protected $script        = 'script';
    protected $link_custom   = 'link-custom';
    protected $script_custom = 'script-custom';
    
    // -------------------------------------------------------------------------
    
    /**
    * Class constructor method
    *
    * @param Array $params
    */
    public function __construct($params)
    {
        $this->name = $params['name'];
        $this->host = $params['host'];
        $this->made = $params['made'];
        
        if(!empty($params['language']))
        {
            $this->language = $params['language'];
        }
        
        if(!empty($params['charset']))
        {
            $this->charset = $params['charset'];
        }
        
        if(!empty($params['description']))
        {
            $this->description = $params['description'];
        }
        
        if(!empty($params['keywords']))
        {
            $this->keywords = $params['keywords'];
        }
        
        if(!empty($params['favorite_icon']))
        {
            $this->favorite_icon = $params['favorite_icon'];
        }
        
        if(!empty($params['logo_front']))
        {
            $this->logo_front = $params['logo_front'];
        }
        
        if(!empty($params['logo_inside']))
        {
            $this->logo_inside = $params['logo_inside'];
        }
        
        if(!empty($params['creator']))
        {
            $this->creator = $params['creator'];
        }
        
        if(!empty($params['creator_name']))
        {
            $this->creator_name = $params['creator_name'];
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
    public function signature($always_made_year=FALSE)
    {
        $current_year = date('Y');
        
        if($current_year === $this->made || $always_made_year)
        {
            $since = $current_year;
        }
        else
        {
            $since = $this->made . '-' . $current_year;
        }
        
        $signature =  'Copyright &#169; ' . $since . ' | ' . $this->creator . ' | All Rights Reserved';
        
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
        if(empty($language))
        {
            $language = $this->language;
        }
        
        $signature_hidden = '<!-- ';
        switch($language)
        {
            case 'EN':
                {
                    $signature_hidden .= 'Proudly built by: ' . $this->creator_name . '; Find me on ' . $this->creator_website;
                } break;
            default: $signature_hidden .= 'Ponosno izradio: ' . $this->creator_name . '; Pronadjite me na ' . $this->creator_website;
        }
        $signature_hidden .=  ' -->' . PHP_EOL;
        
        return $signature_hidden;
    }   
        
    // -------------------------------------------------------------------------
    
    /**
    * Adding css and javascript tags to head of html
    * 
    * Custom tags are also allowed.
    * 
    * @param Array $params
    * 
    * @return void
    */
    public function add_to_head($params)
    {
        if(!empty($params))
        {
            foreach($params as $param)
            {
                if(empty($param['type']))
                {
                    $param['type'] = $this->link;
                }
                
                $this->head[] = array(
                    'path' => $param['path'],
                    'type' => $param['type']
                );
            }
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Adding css and javascript tags to bottom of html
    * 
    * Custom tags are also allowed.
    * 
    * @param Array $params
    * 
    * @return void
    */
    public function add_to_bottom($params)
    {
        if(empty($params))
        {
            foreach($params as $param)
            {
                if(empty($param['type']))
                {
                    $param['type'] = $this->script;
                }
                
                $this->bottom[] = array(
                    'path' => $param['path'],
                    'type' => $param['type']
                );
            }
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Prints meta tags
    * 
    * If no title was given, prints website name
    * 
    * @param String $title
    * 
    * @return String $meta
    */
    public function meta($title='')
    {
        $meta  = '<meta http-equiv="Content-Type" content="text/html; charset=' . $this->charset . '">' . PHP_EOL;
        $meta .= '<meta http-equiv="X-UA-Compatible" content="IE=edge">' . PHP_EOL;
        $meta .= '<meta name="viewport" content="width=device-width, initial-scale=1">' . PHP_EOL;
        $meta .= '<meta name="description" content="' . $this->name . ':' . ' ' . $this->description . '">' . PHP_EOL;
        $meta .= '<meta name="keywords" content="' . $this->keywords . '">' . PHP_EOL;
        $meta .= '<meta name="author" content="' . $this->creator_name . '">' . PHP_EOL;
		$meta .= '<meta name="apple-mobile-web-app-capable" content="yes"/>' .PHP_EOL;
        $meta .= '<link rel="shortcut icon" href="' . $this->favorite_icon . '" type="image/png">' . PHP_EOL;
        
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
    * Prints head tags
    * 
    * @return String $return
    */
    public function head()
    {
        $return = '<!-- HEAD -->' . PHP_EOL;
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
                    case $this->link:    
                        {
                            $return .= '<link rel="stylesheet" href="';
                            $return .= $head['path'];
                            $return .= '">' . PHP_EOL;
                        }
                    break; 
                    case $this->script:    
                        {
                            $return .= '<script src="';
                            $return .= $head['path'];
                            $return .= '"></script>' . PHP_EOL;
                        }
                    break; 
                    case $this->link_custom:    
                        {
                            $return .= '<style>';
                            $return .= $head['path'];
                            $return .= '</style>' . PHP_EOL;
                        }
                    break; 
                    case $this->script_custom:    
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
    * Printing values somewhere in bottom of html
    * 
    * @return String $return
    */
    public function bottom()
    {
        $return = '<!-- BOTTOM -->' . PHP_EOL;
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
                    case $this->link:    
                        {
                            $return .= '<link rel="stylesheet" href="';
                            $return .= $bottom['path'];
                            $return .= '">' . PHP_EOL;
                        }
                    break;
                    case $this->script:    
                        {
                            $return .= '<script src="';
                            $return .= $bottom['path'];
                            $return .= '"></script>' . PHP_EOL;
                        }
                    break;
                    case $this->link_custom:    
                        {
                            $return .= '<style>';
                            $return .= $bottom['path'];
                            $return .= '</style>' . PHP_EOL;
                        }
                    break;
                    case $this->script_custom:    
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
    * Page redirection
    * 
    * Echoes html if page is not properly redirected
    * 
    * @param String $page
    * 
    * @return void
    */
    public function redirect_to_page($page)
    {
        header('Location: ' . $page . '');
        exit();
        
        echo '
            <!doctype html>
            <html lang="en-US">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="refresh" content="1; url=' . $this->host . '">
                    <script>
                        window.location.href = "' . $this->host . '";
                    </script>
                    <title>Page Redirection</title>
                </head>
                <body>
                    If you are not redirected automatically, follow this <a href="' . $this->host . $page . '">link to ' . $this->name . '</a>.
                </body>
            </html>
        ';
    }
    
    // -------------------------------------------------------------------------
}
?>