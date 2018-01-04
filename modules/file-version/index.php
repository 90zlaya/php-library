<?php
/*
| -------------------------------------------------------------------
| FILE VERSION
| -------------------------------------------------------------------
|
| This script looks up for files inside given path for
| those which are changed since certain point in time. 
| 
| If or when it finds them, then creates two files,
| or updates them, with informations about date, version
| and changed files.
|
| -------------------------------------------------------------------
*/
use phplibrary\File as file;
use phplibrary\Directory_Lister as directory_lister;

$current_date = date('Y-m-d');
$new_version  = '1.0';
$log_versions = 'versions';
$log_files    = 'files';

// -----------------------------------------------------------------------------

$listing = directory_lister::listing(array(
    'directory'  => 'D:/Zlatan/Browser/phpmailer/',
    'method'     => 'crawl',
));

// -----------------------------------------------------------------------------

$data = file::read_from_file($log_files);

$is_new = FALSE;
if (empty($data))
{
    $is_new = TRUE;
    
    $contents = $current_date . ' ' . $new_version;
    
    file::write_to_file($log_files, $contents);
    $data = file::read_from_file($log_files);
}

$data_date    = substr($data, 0, 10);
$data_version = substr($data, 11);

// -----------------------------------------------------------------------------

$write_to_file = '';
foreach ($listing['listing'] as $item)
{
    $path = $item['path'];
    $date = $item['date'];
    
    if ($date > $data_date && $data_date !== $current_date)
    {
        $write_to_file .= $path . PHP_EOL;
    }
}

// -----------------------------------------------------------------------------

if ( ! empty($write_to_file))
{
    if ($is_new)
    {
        $latest_version = $new_version;
    }
    else
    {
        $latest_version_root   = substr($data_version, 0, 2);
        $latest_version_number = substr($data_version, -1);
        $latest_version_number += 1;
        
        $latest_version = $latest_version_root . $latest_version_number;
    }
    
    $write_to_log_file = $current_date . ' ' . $latest_version;
    file::write_to_file($log_files, $write_to_log_file);
    
    $write_to_file = $current_date . ' ' . $latest_version . PHP_EOL . PHP_EOL . $write_to_file;
    file::write_to_file($log_versions, $write_to_file);
}

// -----------------------------------------------------------------------------
