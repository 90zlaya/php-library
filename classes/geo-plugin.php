<?php
/**
* Geo_Plugin
*
* Customisation of third-party class geoPlugin 
* Location: http://www.geoplugin.com/
*
* @package      PHP Library
* @subpackage   phplibrary
* @category     Geography
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
namespace phplibrary;

require_once 'third-party/geoplugin.class/geoplugin.class.php';

use geoPlugin as geoPlugin;

/**
* Customisation of third-party class geoPlugin 
* Location: http://www.geoplugin.com/
*/
class Geo_Plugin extends geoPlugin{
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
    * Returns all data
    * 
    * @return Array
    */
    public function data()
    {
        $prefix = isset($_SERVER['HTTPS']) && ! empty($_SERVER['HTTPS']) ? 'https://' : 'http://';
        
        $this->data['base'] = array(
            'location'  => $prefix . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'],
            'referer'   => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : NULL,
            'prefix'    => $prefix,
            'host'      => $_SERVER['HTTP_HOST'],
            'path'      => dirname($_SERVER['PHP_SELF']),
            'page'      => basename($_SERVER['PHP_SELF']),
            'date'      => date('Y-m-d'),
            'time'      => date('H:i:s'),
            'agent'     => $_SERVER['HTTP_USER_AGENT'],
            'address'   => $_SERVER['REMOTE_ADDR'],
        );
        
        $this->data['server'] = array();
        
        foreach ($this->server_indices as $item)
        {
            $this->data['server'] = array_merge($this->data['server'], array(strtolower($item) => isset($_SERVER[$item]) ? $_SERVER[$item] : ''));
        }
        
		$this->data['service'] = array(
            'location'				=> $this->host,
			'ip'                    => $this->ip,
            'city'                  => $this->city,
            'region'                => $this->region,
            'longitude'             => $this->longitude,
            'latitude'              => $this->latitude,
            'area_code'             => $this->areaCode,
            'dma_code'              => $this->dmaCode,
            'country_name'          => $this->countryName,
            'country_code'          => $this->countryCode,
            'continent_code'        => $this->continentCode,
            'currency_symbol'       => $this->currencySymbol,
            'currency_converter'    => $this->currencyConverter,
            'currency_code'         => $this->currencyCode,
        );
        
        return $this->data;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Checks if service returned ip
    * 
    * @return Bool
    */
    public function is_active_service()
    {
        return ! empty($this->data()['service']['ip']);
    }
    
    // -------------------------------------------------------------------------
}
?>