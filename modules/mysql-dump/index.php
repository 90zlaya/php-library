<?php
/*
| -------------------------------------------------------------------
| MySQL Dump
| -------------------------------------------------------------------
|
| This script works on MySQL databases backup
|
| -------------------------------------------------------------------
*/

$folder_name_root = date('ym') . '/';

if ( ! is_dir($folder_name_root))
{
    mkdir($folder_name_root);
}

$folder_name = $folder_name_root . date('d') . '/';

if ( ! is_dir($folder_name))
{
    mkdir($folder_name);
}


$data = array(
    array(
        'database' => 'database1',
    ),
    array(
        'database' => 'database2',
    ),
    array(
        'database' => 'database3',
    ),
    array(
        'database' => 'database4',
    ),
    array(
        'database' => 'database5',
    ),
);

foreach ($data as $item)
{
    $filename = $folder_name . date('ymdHis') . '_-_' . $item['database'] . '.sql';
    
    $command  = 'mysqldump ' . $item['database'];
    $command .= ' --user=username';
    $command .= ' --password=password';
    $command .= ' --host=localhost';
    $command .= ' > ' . $filename;
    
    try
    {
        exec($command);
        
        echo 'Executed: ' . $command . "\r\n\r\n";
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
    }
}

exit(0);
