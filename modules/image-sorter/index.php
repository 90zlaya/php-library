<?php
/*
| -------------------------------------------------------------------
| IMAGE SORTER
| -------------------------------------------------------------------
|
| Crawls for files in one folder, creates new folders according to
| files prefix and copies them to that newly created folder.
| 
| -------------------------------------------------------------------
*/
include '../../autoload.php';

// Maximum execution time if there are over 50 000 files
ini_set('max_execution_time', 3600); // 3600 s = 1 h

$where_to_read_files = 'D:/Browser/slikeVelike/';
$where_to_make_dir = 'D:/Browser/CDN/';
$folder_sufix = '000';
$number_of_directories = 1000;

// -----------------------------------------------------------------------------

/**
* Report array
*/
$image_sorter = array(
    'folders' => array(
        'number' => array(
            'created'     => 0,
            'not_created' => 0,
        ),
        'report' => array(
            'created'     => array(),
            'not_created' => array(),
        ),
    ),
    'files' => array(
        'number' => array(
            'copied'     => 0,
            'not_copied' => 0,
        ),
        'report' => array(
            'copied'     => array(),
            'not_copied' => array(),
        ),
    ),
);

// -----------------------------------------------------------------------------

/**
* Crawl for files
*/
$params = array(
    'directory' => $where_to_read_files,
    'method'    => 'files',
    'types'     => array('jpg'),
);
$listing = phplibrary\Directory_Lister::listing($params);
phplibrary\Format::pre($listing, FALSE);

// -----------------------------------------------------------------------------

/**
* Create directories
*/
for ($i=0; $i<$number_of_directories; $i++)
{
    $i_length = strlen($i);
    
    if ($i_length < 4)
    {
        switch ($i_length)
        {
            case 1:
                {
                    $folder_prefix = '00' . $i;
                } break;
            case 2:
                {
                    $folder_prefix = '0' . $i;
                } break;
            case 3:
                {
                    $folder_prefix = $i;
                } break;
        }
        
        $folder = $folder_prefix . $folder_sufix;
    }
    
    $new_folder = $where_to_make_dir . $folder;
    
    if (!file_exists($new_folder))
    {
        $is_created = @mkdir($new_folder);
        
        if ($is_created)
        {
            $image_sorter['folders']['number']['created']++;
            array_push($image_sorter['folders']['report']['created'], $new_folder);
        }
        else
        {
            $image_sorter['folders']['number']['not_created']++;
            array_push($image_sorter['folders']['report']['not_created'], $new_folder);
        }
    }
}

// -----------------------------------------------------------------------------

/**
* Move files to created directories
*/
foreach ($listing['listing'] as $item)
{
    $file = $item['file'];
    $file_prefix = substr($file, 0, 3);
    
    $location_from = $where_to_read_files . $file;
    $location_to = $where_to_make_dir . $file_prefix . $folder_sufix . '/' . $file;
    
    $is_copied = @copy($location_from, $location_to);
    
    if ($is_copied)
    {
        $image_sorter['files']['number']['copied']++;
        array_push($image_sorter['files']['report']['copied'], $file);
    }
    else
    {
        $image_sorter['files']['number']['not_copied']++;
        array_push($image_sorter['files']['report']['not_copied'], $file);
    }
}

// -----------------------------------------------------------------------------

echo 'Folders created/not created: ' . $image_sorter['folders']['number']['created'] . '/' . $image_sorter['folders']['number']['not_created'] . '<br/>';
echo 'Files copied/not copied: ' . $image_sorter['files']['number']['copied'] . '/' . $image_sorter['files']['number']['not_copied'] . '<br/>';

phplibrary\Format::pre($image_sorter);

?>