<?php
/*
| -------------------------------------------------------------------
| GEO PLUGIN
| -------------------------------------------------------------------
|
| Customisation of third-party class geoPlugin 
| Location: http://www.geoplugin.com/
|
| -------------------------------------------------------------------
*/
namespace phplibrary;

require_once 'third-party/geoplugin.class/geoplugin.class.php';

use geoPlugin as geoPlugin;

class Geo_Plugin extends geoPlugin {
    protected $data = array();
    
    // -------------------------------------------------------------------------
    
    /**
    * Class constructor
    * 
    */
    public function __construct()
    {
        parent::__construct();
        
        $this->data['base'] = array(
            'location'              => $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'],
            'referer'               => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : NULL,
            'host'                  => $_SERVER['HTTP_HOST'],
            'path'                  => dirname($_SERVER['PHP_SELF']),
            'page'                  => basename($_SERVER['PHP_SELF']),
            'date'                  => date('Y-m-d'),
            'time'                  => date('H:i:s'),
            'agent'                 => $_SERVER['HTTP_USER_AGENT'],
            'address'               => $_SERVER['REMOTE_ADDR'],
        );
        $this->data['service'] = array(
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
    }

    // -------------------------------------------------------------------------
    
    /**
    * Checks if service returned ip
    * 
    * @return Bool
    */
    public function is_active_service()
    {
        if ( ! empty($this->data['service']['ip']))
        {
            return TRUE;
        }
        
        return FALSE;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Returns all data
    * 
    * @return Array $this->info
    */
    public function data()
    {
        return $this->data;
    }
    
    // -------------------------------------------------------------------------
}
?>