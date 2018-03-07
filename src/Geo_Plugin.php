<?php
/**
* Geo_Plugin
*
* Geography location and other server and browser
* data collected from visitor
*
* @package      PHP Library
* @subpackage   phplibrary
* @category     Data
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
namespace phplibrary;

use phplibrary\Web_Service as web_service;

/**
* Geography location and other server and browser
* data collected from visitor
*/
class Geo_Plugin {
    
    // -------------------------------------------------------------------------
    
    /**
    * Service code for geoPlugin
    * 
    * @var int
    */
    public $code = 0;
    
    // -------------------------------------------------------------------------
    
    /**
    * Geo_Plugin data is stored here
    * 
    * @var Array
    */
    protected $data = array();
    
    // -------------------------------------------------------------------------
    
    /**
    * Server PHP indices
    * 
    * @var Array
    */
    protected $server_indices = array(
        'PHP_SELF',
        'argv',
        'argc',
        'GATEWAY_INTERFACE',
        'SERVER_ADDR',
        'SERVER_NAME',
        'SERVER_SOFTWARE',
        'SERVER_PROTOCOL',
        'REQUEST_METHOD',
        'REQUEST_TIME',
        'REQUEST_TIME_FLOAT',
        'QUERY_STRING',
        'DOCUMENT_ROOT',
        'HTTP_ACCEPT',
        'HTTP_ACCEPT_CHARSET',
        'HTTP_ACCEPT_ENCODING',
        'HTTP_ACCEPT_LANGUAGE',
        'HTTP_CONNECTION',
        'HTTP_HOST',
        'HTTP_REFERER',
        'HTTP_USER_AGENT',
        'HTTPS',
        'REMOTE_ADDR',
        'REMOTE_HOST',
        'REMOTE_PORT',
        'REMOTE_USER',
        'REDIRECT_REMOTE_USER',
        'SCRIPT_FILENAME',
        'SERVER_ADMIN',
        'SERVER_PORT',
        'SERVER_SIGNATURE',
        'PATH_TRANSLATED',
        'SCRIPT_NAME',
        'REQUEST_URI',
        'PHP_AUTH_DIGEST',
        'PHP_AUTH_USER',
        'PHP_AUTH_PW',
        'AUTH_TYPE',
        'PATH_INFO',
        'ORIG_PATH_INFO',
    );
    
    // -------------------------------------------------------------------------
    
    /**
    * Service for Geo_Plugin
    * 
    * @var String
    */
    protected $geo_plugin_service = 'http://www.geoplugin.net/php.gp?ip={IP}';
    
    // -------------------------------------------------------------------------
    
    /**
    * Visitor IP address
    * 
    * @var String
    */
    protected $visitor_ip = '';
    
    // -------------------------------------------------------------------------
    
    /**
    * Returns all data
    * 
    * @return Array
    */
    public function data()
    {
        $this->data['base']   = $this->base_information();
        $this->data['server'] = $this->server_information();
        $this->data['geo']    = $this->geo_information();
        
        return $this->data;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Base information from visitor
    * 
    * @return Array
    */
    protected function base_information()
    {
        $prefix = isset($_SERVER['HTTPS']) && ! empty($_SERVER['HTTPS'])
            ? 'https://' 
            : 'http://';
                
        $http_host = isset($_SERVER['HTTP_HOST'])
            ? $_SERVER['HTTP_HOST']
            : NULL;
        
        $php_self = isset($_SERVER['PHP_SELF'])
            ? $_SERVER['PHP_SELF']
            : NULL;
        
        $http_referer = isset($_SERVER['HTTP_REFERER'])
            ? $_SERVER['HTTP_REFERER']
            : NULL;
        
        $http_user_agent = isset($_SERVER['HTTP_USER_AGENT'])
            ? $_SERVER['HTTP_USER_AGENT']
            : NULL;
        
        $remote_addr = isset($_SERVER['REMOTE_ADDR'])
            ? $_SERVER['REMOTE_ADDR']
            : NULL;
        
        $this->visitor_ip = $remote_addr;
        
        return array(
            'location'  => $prefix . $http_host . $php_self,
            'referer'   => $http_referer,
            'prefix'    => $prefix,
            'host'      => $http_host,
            'path'      => dirname($php_self),
            'page'      => basename($php_self),
            'date'      => date('Y-m-d'),
            'time'      => date('H:i:s'),
            'agent'     => $http_user_agent,
            'address'   => $remote_addr,
        );
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Server indices information
    * 
    * @return Array $server
    */
    protected function server_information()
    {
        $server = array();
        
        foreach ($this->server_indices as $item)
        {
            $key   = strtolower($item);
            $value = isset($_SERVER[$item]) ? $_SERVER[$item] : '';
            
            $server = array_merge($server, array($key => $value));
        }
        
        return $server;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Information from geoPlugin
    * 
    * @param String $ip
    * 
    * @return mixed
    */
    public function geo_information($ip='')
    {
        $response = array();
        
        empty($ip) ? $ip = $this->visitor_ip : NULL;
        
        $host = str_replace('{IP}', $ip, $this->geo_plugin_service);
        
        if (function_exists('curl_init'))
        {
            $response = web_service::response($host, array(
                'user_agent' => 'Geo_Plugin class from bit.ly/php-library',
            ));
        }
        elseif (ini_get('allow_url_fopen'))
        {
            $response = file_get_contents($host, 'r');
        }
        else
        {
            return FALSE;
        }
        
        $geo_information = unserialize($response);
        $this->code      = $geo_information['geoplugin_status'];
        
        return $geo_information;
    }
    
    // -------------------------------------------------------------------------
}
