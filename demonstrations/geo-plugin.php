<?php
/*
| -------------------------------------------------------------------
| GEO PLUGIN
| -------------------------------------------------------------------
|
| Developing and testing Geo_Plugin class
|
| -------------------------------------------------------------------
*/
include_once '../autoload.php';

$geo_plugin = new phplibrary\Geo_Plugin();
$geo_plugin->locate();

if ($geo_plugin->is_active_service())
{
    echo 'Active service, all data returned.<br/>';
}
else
{
    echo 'Inactive service, only base data returned.<br/>';
}
    
phplibrary\Format::pre($geo_plugin->data());
