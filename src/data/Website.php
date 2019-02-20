<?php
/**
* Website
*
* Use when working with website related data.
*
* @package      PHP_Library
* @subpackage   League
* @category     Data
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
namespace PHP_Library\League\Data;

use Exception as Exception;

/**
* Use when working with website related data
*/
class Website {

    // -------------------------------------------------------------------------

    /**
    * Filled if something unpredicted occurs
    *
    * @var array
    */
    public $errors = array();

    // -------------------------------------------------------------------------

    /**
    * Server data holder
    *
    * @var array
    */
    public $server = array();

    // -------------------------------------------------------------------------

    /**
    * Website name
    *
    * @var string
    */
    public $name;

    // -------------------------------------------------------------------------

    /**
    * Website host
    *
    * @var string
    */
    public $host;

    // -------------------------------------------------------------------------

    /**
    * Year when website was made
    *
    * @var string
    */
    public $made;

    // -------------------------------------------------------------------------

    /**
    * Website language
    *
    * @var string
    */
    public $language = 'EN';

    // -------------------------------------------------------------------------

    /**
    * Website charset
    *
    * @var string
    */
    public $charset = 'UTF-8';

    // -------------------------------------------------------------------------

    /**
    * Website description
    *
    * @var string
    */
    public $description = 'Simple website';

    // -------------------------------------------------------------------------

    /**
    * Website keywords
    *
    * @var string
    */
    public $keywords = 'simple, website';

    // -------------------------------------------------------------------------

    /**
    * Head data
    *
    * @var array
    */
    private $head = array();

    // -------------------------------------------------------------------------

    /**
    * Bottom data
    *
    * @var array
    */
    private $bottom = array();

    // -------------------------------------------------------------------------

    /**
    * Available website images
    *
    * @var array
    */
    private $images = array(
        'icon' => 'https://php-library.zlatanstajic.com/assets/img/phplibrary-icon.png',
        'logo' => 'https://php-library.zlatanstajic.com/assets/img/phplibrary-logo-blue.png',
    );

    // -------------------------------------------------------------------------

    /**
    * Website creator data
    *
    * @var array
    */
    private $creator = array(
        'name'    => 'Zlatan Stajić',
        'website' => 'https://www.zlatanstajic.com/',
        'email'   => 'contact@zlatanstajic.com',
    );

    // -------------------------------------------------------------------------

    /**
    * Head and bottom data calss
    *
    * @var array
    */
    private $calls = array(
        'css'        => array(
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
    * @param array $params
    *
    * @return void
    */
    public function __construct($params)
    {
        $host = isset($_SERVER['HTTP_HOST'])
            ? $_SERVER['HTTP_HOST']
            : NULL;

        $self = isset($_SERVER['PHP_SELF'])
            ? $_SERVER['PHP_SELF']
            : NULL;

        $request_uri = isset($_SERVER['REQUEST_URI'])
            ? $_SERVER['REQUEST_URI']
            : NULL;

        $referer = isset($_SERVER['HTTP_REFERER'])
            ? $_SERVER['HTTP_REFERER']
            : NULL;

        $this->server['location'] = $host . $self;
        $this->server['referer']  = $referer;
        $this->server['host']     = $host;
        $this->server['uri']      = $request_uri;
        $this->server['path']     = dirname($self);
        $this->server['page']     = basename($self);

        isset($params['name'])
            ? $this->name = $params['name']
            : array_push($this->errors, array(
                'Please set "name" parameter when using constructor',
            ));

        isset($params['host'])
            ? $this->host = $params['host']
            : array_push($this->errors, array(
                'Please set "host" parameter when using constructor',
            ));

        isset($params['made'])
            ? $this->made = $params['made']
            : array_push($this->errors, array(
                'Please set "made" parameter when using constructor',
            ));

        empty($params['language'])
            ? NULL
            : $this->language = $params['language'];

        empty($params['charset'])
            ? NULL
            : $this->charset = $params['charset'];

        empty($params['description'])
            ? NULL
            : $this->description = $params['description'];

        empty($params['keywords'])
            ? NULL
            : $this->keywords = $params['keywords'];
    }

    // -------------------------------------------------------------------------

    /**
    * Adding css and javascript tags to head of html
    *
    * @param array $params
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
    * @param array $params
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
    * @param array $params
    * @param bool $to_merge
    *
    * @return void
    */
    public function add_to_images($params, $to_merge=FALSE)
    {
        if ($to_merge)
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
    * @param array $params
    * @param bool $to_merge
    *
    * @return void
    */
    public function add_to_creator($params, $to_merge=FALSE)
    {
        if ($to_merge)
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
    * @param array $params
    *
    * @return string $meta
    */
    public function meta($params=array())
    {
        $meta = '';

        $title = isset($params['title'])
            ? $params['title']
            : '';

        $shortcut_icon = isset($params['shortcut_icon'])
            ? $params['shortcut_icon']
            : $this->images['icon'];

        $touch_icon = isset($params['touch_icon'])
            ? $params['touch_icon']
            : $this->images['icon'];

        if (isset($params['google_site_verification']))
        {
            $meta .= '<meta name="google-site-verification" content="';
            $meta .= $params['google_site_verification'];
            $meta .= '"/>';
            $meta .= PHP_EOL;
        }

        $meta .= '<meta http-equiv="Content-Type" content="text/html; charset=';
        $meta .= $this->charset;
        $meta .= '">';
        $meta .= PHP_EOL;
        $meta .= '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
        $meta .= PHP_EOL;
        $meta .= '<meta name="viewport" content="width=device-width, initial-scale=1">';
        $meta .= PHP_EOL;
        $meta .= '<meta name="description" content="';
        $meta .= $this->description;
        $meta .= '">';
        $meta .= PHP_EOL;
        $meta .= '<meta name="keywords" content="';
        $meta .= $this->keywords;
        $meta .= '">';
        $meta .= PHP_EOL;
        $meta .= '<meta name="author" content="';
        $meta .= $this->creator['name'];
        $meta .= '">';
        $meta .= PHP_EOL;
        $meta .= '<meta name="apple-mobile-web-app-capable" content="yes"/>';
        $meta .= PHP_EOL;
        $meta .= '<link rel="apple-touch-icon" sizes="';
        $meta .= $this->image_size($touch_icon)['width_height'];
        $meta .= '" href="';
        $meta .= $touch_icon;
        $meta .= '"/>';
        $meta .= PHP_EOL;
        $meta .= '<link rel="shortcut icon" href="';
        $meta .= $shortcut_icon;
        $meta .= '" type="image/png">';
        $meta .= PHP_EOL;
        $meta .= '<title>';
        $meta .= empty($title) ? $this->name : $title;
        $meta .= '</title>' . PHP_EOL;

        return $meta;
    }

    // -------------------------------------------------------------------------

    /**
    * Printing values in head of html
    *
    * @return string $return
    */
    public function head()
    {
        $return = '';

        $return .= '<!-- HEAD -->' . PHP_EOL;

        if (empty($this->head))
        {
            $return .= '<!-- NOT LOADED -->' . PHP_EOL;
        }
        else
        {
            foreach ($this->head as $head)
            {
                switch ($head['type'])
                {
                    case $this->calls['css']['ordinary']:
                    {
                        $return .= '<link rel="stylesheet" href="';
                        $return .= $head['path'];
                        $return .= '">' . PHP_EOL;
                        break;
                    }
                    case $this->calls['javascript']['ordinary']:
                    {
                        $return .= '<script src="';
                        $return .= $head['path'];
                        $return .= '"></script>' . PHP_EOL;
                        break;
                    }
                    case $this->calls['css']['custom']:
                    {
                        $return .= '<style>';
                        $return .= $head['path'];
                        $return .= '</style>' . PHP_EOL;
                        break;
                    }
                    case $this->calls['javascript']['custom']:
                    {
                        $return .= '<script>';
                        $return .= $head['path'];
                        $return .= '</script>' . PHP_EOL;
                        break;
                    }
                    default: NULL;
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
    * @return string $return
    */
    public function bottom()
    {
        $return = '';

        $return .= '<!-- BOTTOM -->' . PHP_EOL;

        if (empty($this->bottom))
        {
            $return .= '<!-- NOT LOADED -->' . PHP_EOL;
        }
        else
        {
            foreach ($this->bottom as $bottom)
            {
                switch ($bottom['type'])
                {
                    case $this->calls['css']['ordinary']:
                    {
                        $return .= '<link rel="stylesheet" href="';
                        $return .= $bottom['path'];
                        $return .= '">' . PHP_EOL;
                        break;
                    }
                    case $this->calls['javascript']['ordinary']:
                    {
                        $return .= '<script src="';
                        $return .= $bottom['path'];
                        $return .= '"></script>' . PHP_EOL;
                        break;
                    }
                    case $this->calls['css']['custom']:
                    {
                        $return .= '<style>';
                        $return .= $bottom['path'];
                        $return .= '</style>' . PHP_EOL;
                        break;
                    }
                    case $this->calls['javascript']['custom']:
                    {
                        $return .= '<script>';
                        $return .= $bottom['path'];
                        $return .= '</script>' . PHP_EOL;
                        break;
                    }
                    default: NULL;
                }
            }
        }

        $return .= '<!-- /BOTTOM -->' . PHP_EOL;

        return $return;
    }

    // -------------------------------------------------------------------------

    /**
    * Printing creator data
    *
    * @param string $creator
    *
    * @return mixed
    */
    public function creator($creator)
    {
        if ( ! empty($creator) && array_key_exists($creator, $this->creator))
        {
            return $this->creator[$creator];
        }

        return FALSE;
    }

    // -------------------------------------------------------------------------

    /**
    * Printing images
    *
    * @param string $image
    *
    * @return mixed
    */
    public function images($image)
    {
        if ( ! empty($image) && array_key_exists($image, $this->images))
        {
            return $this->images[$image];
        }

        return FALSE;
    }

    // -------------------------------------------------------------------------

    /**
    * Printing image size value
    *
    * @param string $image
    *
    * @return mixed
    */
    public function image_size($image)
    {
        try
        {
            $image_size = getimagesize($image);
        }
        catch (Exception $e)
        {
            array_push($this->errors, array(
                $e->getMessage(),
            ));
        }

        if ( ! empty($image_size))
        {
            return array(
                'width'        => $image_size[0],
                'height'       => $image_size[1],
                'width_height' => $image_size[0] . 'x' . $image_size[1],
                'type'         => $image_size[2],
                'size'         => $image_size[3],
                'bits'         => $image_size['bits'],
                'mime'         => $image_size['mime'],
            );
        }

        return FALSE;
    }

    // -------------------------------------------------------------------------

    /**
    * Footer signature of creator and year when it was made
    *
    * When you want year span (eg. 2007-2017) set
    * first method parameter as TRUE.
    *
    * @param bool $always_made_year
    * @param bool $show_licence
    *
    * @return string
    */
    public function signature($always_made_year=FALSE, $show_licence=FALSE)
    {
        $licence = '';

        $since = $current_year = date('Y');

        if ($always_made_year)
        {
            $since = $this->made;
        }
        elseif ($current_year != $this->made)
        {
            $since = $this->made . '-' . $current_year;
        }

        $show_licence ? $licence = ' | All Rights Reserved' : NULL;

        return 'Copyright &#169; ' .
            $since .
            ' | <a href="' .
            $this->creator['website'] .
            '" target="_blank">' .
            $this->creator['name'] .
            '</a>' .
            $licence;
    }

    // -------------------------------------------------------------------------

    /**
    * Adds html comment to page view-source
    *
    * If language parameter is not passed to method,
    * default website language comment will be shown.
    *
    * @param string $language
    *
    * @return string $signature_hidden
    */
    public function signature_hidden($language='')
    {
        $signature_hidden = '';

        empty($language) ? $language = $this->language : NULL;

        $signature_hidden .= PHP_EOL;
        $signature_hidden .= '<!-- ';

        switch ($language)
        {
            case 'EN':
            case 'english':
            {
                $signature_hidden .= 'Proudly built by: ';
                $signature_hidden .= $this->creator['name'];
                $signature_hidden .= '; Find me on ';
                $signature_hidden .= $this->creator['website'];

                break;
            }
            default:
            {
                $signature_hidden .= 'Ponosno izradio: ';
                $signature_hidden .= $this->creator['name'];
                $signature_hidden .= '; Pronadjite me na ';
                $signature_hidden .= $this->creator['website'];
            }
        }

        $signature_hidden .= ' -->';
        $signature_hidden .= PHP_EOL;

        return $signature_hidden;
    }

    // -------------------------------------------------------------------------
}
