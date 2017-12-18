<?php
/*
| -------------------------------------------------------------------
| SORTER
| -------------------------------------------------------------------
|
| Sortes files to multiple folders.
| 
| -------------------------------------------------------------------
*/
namespace phplibrary;

file_exists('autoload.php') ? require_once 'autoload.php' : require_once '../autoload.php';

use phplibrary\Directory_Lister as Directory_Lister;

class Sorter {
    protected $report = array(
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
    protected $params = array(
        'where_to_read_files'           => '',
        'where_to_create_directories'   => '',
        'number_of_directories'         => 0,
        'folder_suffix'                 => '',
        'types'                         => array(),
        'max_execution_time'            => 3600,
    );
    
    // -------------------------------------------------------------------------
    
    /**
    * Class constructor
    * 
    */
    public function __construct()
    {
        ini_set('max_execution_time', $this->params['max_execution_time']);
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Deploy sorting process 
    * 
    * @return Array
    */
    public function deploy($params)
    {
        $this->params = $params;
        
        $this->create_directories();
        $this->move_files(
            $this->crawl_for_files()
        );
        
        return $this->report();
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Crawl for files
    * 
    * @return Array
    */
    protected function crawl_for_files()
    {
        return Directory_Lister::listing(array(
            'directory' => $this->params['where_to_read_files'],
            'method'    => 'files',
            'types'     => $this->params['types'],
        ));
    }
    
    // -------------------------------------------------------------------------

    /**
    * Create directories
    * 
    * @return void
    */
    protected function create_directories()
    {
        for ($i=0; $i<$this->params['number_of_directories']; $i++)
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
                    default: $folder_prefix = '';
                }
                
                $folder = $folder_prefix . $this->params['folder_sufix'];
            }
            
            $new_folder = $this->params['where_to_create_directories'] . $folder;
            
            if ( ! file_exists($new_folder))
            {
                $is_created = @mkdir($new_folder);
                
                if ($is_created)
                {
                    $this->report['folders']['number']['created']++;
                    array_push($this->report['folders']['report']['created'], $new_folder);
                }
                else
                {
                    $this->report['folders']['number']['not_created']++;
                    array_push($this->report['folders']['report']['not_created'], $new_folder);
                }
            }
        }
    }
    
    // -------------------------------------------------------------------------

    /**
    * Move files to created directories
    * 
    * @return void
    */
    protected function move_files($listing)
    {
        if (isset($listing['listing']))
        {
            foreach ($listing['listing'] as $item)
            {
                $file           = $item['file'];
                $file_prefix    = substr($file, 0, 3);
                
                $location_from  = $this->params['where_to_read_files'] . $file;
                $location_to    = $this->params['where_to_create_directories'] . $file_prefix . $this->params['folder_sufix'] . '/' . $file;
                
                if (@copy($location_from, $location_to))
                {
                    $this->report['files']['number']['copied']++;
                    array_push($this->report['files']['report']['copied'], $file);
                }
                else
                {
                    $this->report['files']['number']['not_copied']++;
                    array_push($this->report['files']['report']['not_copied'], $file);
                }
            }
        }
    }

    // -------------------------------------------------------------------------
    
    /**
    * Information about sorting process
    * 
    * @return Array
    */
    protected function report()
    {
        $report  = 'Folders created/not created: ';
        $report .= $this->report['folders']['number']['created'];
        $report .= '/';
        $report .= $this->report['folders']['number']['not_created'];
        $report .= '<br/>';
        
        $report .= 'Files copied/not copied: ';
        $report .= $this->report['files']['number']['copied'];
        $report .= '/';
        $report .= $this->report['files']['number']['not_copied'];
        $report .= '<br/>';

        return array(
            'string' => $report,
            'array'  => $this->report
        );
    }
    
    // -------------------------------------------------------------------------
}
?>