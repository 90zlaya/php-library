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

require_once '../third-party/geoplugin.class/geoplugin.class.php';

use geoPlugin as geoPlugin;

class Geo_Plugin extends geoPlugin{
    protected $data = array();
    
    // -------------------------------------------------------------------------
    
    /**
    * Returns all data
    * 
    */
    public function data()
    {
        $host = $_SERVER['HTTP_HOST'];
        $path = dirname($_SERVER['PHP_SELF']);
        $page = basename($_SERVER['PHP_SELF']);
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $ua   = $_SERVER['HTTP_USER_AGENT'];

        $this->data = array(
            'host'                  => $host,
            'path'                  => $path,
            'page'                  => $page,
            'date'                  => $date,
            'time'                  => $time,
            'ua'                    => $ua,
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
}
?>