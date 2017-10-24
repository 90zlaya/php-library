<?php
/*
| -------------------------------------------------------------------
| FILE
| -------------------------------------------------------------------
|
| Developing and testing File class
|
| -------------------------------------------------------------------
*/
include_once '../autoload.php';

$current_date  = date('Y-m-d');
$write_to_file = '';

$log_versions = '../log_versions';
$log_file = '../log_file';
$directory_list_folder = 'D:/Zlatan/Browser/phpmailer/';

$data = File::read_from_file($log_file);
if(empty($data))
{
    $is_new = TRUE;
    $new_version = '1.0';
    
    $contents = $current_date . ' ' . $new_version;
    
    File::write_to_file($log_file, $contents);
    $data = File::read_from_file($log_file);
}
else
{
    $is_new = FALSE;
}

$data_date    = substr($data, 0, 10);
$data_version = substr($data, 11);

$params = array(
    'directory'  => $directory_list_folder,
    'method'     => 'crawl',
);
$listing = Directory_Lister::listing($params);

foreach($listing['listing'] as $item)
{
    $path = $item['path'];
    $date = $item['date'];
    
    if($date >= $data_date)
    {
        $write_to_file .= $path . PHP_EOL;
    }
}

if(!empty($write_to_file))
{
    if($is_new)
    {
        $latest_version = $new_version;
    }
    else
    {
        $latest_version_root = substr($data_version, 0, 2);
        $latest_version_number = substr($data_version, -1);
        $latest_version_number += 1;
        
        $latest_version = $latest_version_root . $latest_version_number;
    }
    
    $write_to_file = $current_date . ' ' . $latest_version . PHP_EOL . PHP_EOL . $write_to_file;
    File::write_to_file($log_versions, $write_to_file);
    echo 'Data written to file ' . $log_file . '<br/>';
    
    
    /*$write_to_file = $current_date . ' bla ' . $latest_version . PHP_EOL .  $data;
    echo $data;*/
    /*File::write_to_file($log_file, $write_to_file);
    echo 'Data written to file ' . $log_file . '<br/>';*/
}
