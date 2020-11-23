<?php
/**
* Sorter
*
* Sortes files to multiple folders
*
* @package      PHP_Library
* @subpackage   Core
* @category     Files
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
namespace PHP_Library\Core\Files;

use PHP_Library\System\Examinations\Testing;

/**
* Sortes files to multiple folders
*/
class Sorter extends Testing {

    /* ---------------------------------------------------------------------- */

    /**
    * Sorter report
    *
    * @var array
    */
    private $report = array(
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
        'files'   => array(
            'number' => array(
                'copied'     => 0,
                'not_copied' => 0,
                'moved'      => 0,
                'not_moved'  => 0,
            ),
            'report' => array(
                'copied'     => array(),
                'not_copied' => array(),
                'moved'      => array(),
                'not_moved'  => array(),
            ),
        ),
    );

    /* ---------------------------------------------------------------------- */

    /**
    * Deploy values
    *
    * @var array
    */
    private $deploy = array();

    /* ---------------------------------------------------------------------- */

    /**
    * Class constructor
    *
    * @param array $params
    *
    * @return void
    */
    public function __construct($params)
    {
        $this->deploy = $params;

        isset($this->deploy['where_to_read_files'])
            ? NULL
            : $this->deploy['where_to_read_files'] = '';

        isset($this->deploy['where_to_create_directories'])
            ? NULL
            : $this->deploy['where_to_create_directories'] = '';

        isset($this->deploy['folder_sufix'])
            ? NULL
            : $this->deploy['folder_sufix'] = '';

        isset($this->deploy['operation'])
            ? NULL
            : $this->deploy['operation'] = 'c';

        isset($this->deploy['overwrite'])
            ? NULL
            : $this->deploy['overwrite'] = FALSE;

        isset($this->deploy['settings'])
            ? NULL
            : $this->deploy['settings'] = array(
                'max_execution_time' => 3600,
            );

        ini_set(
            'max_execution_time',
            $this->deploy['settings']['max_execution_time']
        );
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Deploy sorting process
    *
    * @return bool
    */
    public function deploy()
    {
        if ( ! $this->has_errors())
        {
            $this->create_directories();
            $this->transport_files(
                $this->get_files(),
                $this->deploy['operation'],
                $this->deploy['overwrite']
            );
        }

        return ! $this->has_errors() && $this->is_sorting_successful();
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Crawl for files
    *
    * @return array
    */
    private function get_files()
    {
        $arr_files = array();

        $files_param = 'where_to_read_files';

        if (file_exists($this->deploy[$files_param]))
        {
            $files           = (array) scandir($this->deploy[$files_param]);
            $number_of_files = 0;
            $counter         = 1;

            foreach ($files as $file)
            {
                if ($counter > 2)
                {
                    $file = strval($file);

                    if (stripos($file, '.'))
                    {
                        $extension         = pathinfo($file, PATHINFO_EXTENSION);
                        $extension_lowered = strtolower($extension);

                        if (
                            empty($this->deploy['types']) ||
                            in_array($extension_lowered, $this->deploy['types'])
                        )
                        {
                            array_push($arr_files, array(
                                'path'      => $this->deploy[$files_param] . $file,
                                'directory' => $this->deploy[$files_param],
                                'file'      => $file,
                                'title'     => basename($file, '.' . $extension),
                            ));

                            $number_of_files += 1;
                        }
                    }
                }

                $counter++;
            }
        }
        else
        {
            $this->set_error('Improperly set ' . $files_param . ' parameter');
        }

        return $arr_files;
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Create directories
    *
    * @return void
    */
    private function create_directories()
    {
        $directories_param = 'where_to_create_directories';

        if (file_exists($this->deploy[$directories_param]))
        {
            $number_of_directories = 'number_of_directories';

            if (empty($this->deploy[$number_of_directories]))
            {
                $this->set_error('Please set ' . $number_of_directories . ' parameter');
            }
            else
            {
                for ($i=0; $i<$this->deploy['number_of_directories']; $i++)
                {
                    $folder = $this->folder_name($i);

                    if ( ! file_exists($folder))
                    {
                        if (mkdir($folder) && ! $this->is_being_tested())
                        {
                            $this->report['folders']['number']['created']++;
                            array_push(
                                $this->report['folders']['report']['created'],
                                $folder
                            );
                        }
                        else
                        {
                            $this->report['folders']['number']['not_created']++;
                            array_push(
                                $this->report['folders']['report']['not_created'],
                                $folder
                            );
                        }
                    }
                }

            }
        }
        else
        {
            $this->set_error('Improperly set ' . $directories_param . ' parameter');
        }
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Transport files to created directories
    *
    * @param array $files
    * @param string $operation
    * @param bool $overwrite
    *
    * @return void
    */
    private function transport_files($files, $operation, $overwrite)
    {
        if ( ! empty($files))
        {
            foreach ($files as $item)
            {
                $location_from  = $this->deploy['where_to_read_files'];
                $location_from .= $item['file'];

                $location_to  = $this->deploy['where_to_create_directories'];
                $location_to .= substr($item['file'], 0, 3);
                $location_to .= $this->deploy['folder_sufix'];
                $location_to .= '/';
                $location_to .= $item['file'];

                if ($overwrite)
                {
                    $this->execute_operation(
                        $operation,
                        $location_from,
                        $location_to,
                        $item['file']
                    );
                }
                else
                {
                    if ( ! file_exists($location_to))
                    {
                        $this->execute_operation(
                            $operation,
                            $location_from,
                            $location_to,
                            $item['file']
                        );
                    }
                }
            }
        }
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Execute operation
    *
    * @param string $operation
    * @param string $location_from
    * @param string $location_to
    * @param string $item
    *
    * @return void
    */
    private function execute_operation($operation, $location_from, $location_to, $item)
    {
        switch ($operation)
        {
            case 'm':
            {
                $this->move_files($location_from, $location_to, $item);

                break;
            }
            case 'c':
            default: $this->copy_files($location_from, $location_to, $item);
        }
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Information about sorting process
    *
    * @return array
    */
    public function report()
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
        $report .= 'Files moved/not moved: ';
        $report .= $this->report['files']['number']['moved'];
        $report .= '/';
        $report .= $this->report['files']['number']['not_moved'];
        $report .= '<br/>';

        return array(
            'bool'   => array(
                'no_errors'          => ! $this->has_errors(),
                'successful_sorting' => $this->is_sorting_successful(),
                'something_to_sort'  => ! $this->has_nothing_to_sort(),
            ),
            'string' => $report,
            'array'  => array(
                'usage'  => getrusage(),
                'result' => $this->report,
            ),
        );
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Folder name
    *
    * @param int $i
    *
    * @return string
    */
    private function folder_name($i)
    {
        switch (strlen(strval($i)))
        {
            case 1:
            {
                $folder_prefix = '00' . $i;
                break;
            }
            case 2:
            {
                $folder_prefix = '0' . $i;
                break;
            }
            case 3:
            {
                $folder_prefix = $i;
                break;
            }
            default: $folder_prefix = '';
        }

        return $this->deploy['where_to_create_directories'] .
            $folder_prefix .
            $this->deploy['folder_sufix'];
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Copy files from one location to another
    *
    * @param string $location_from
    * @param string $location_to
    * @param string $file
    *
    * @return void
    */
    private function copy_files($location_from, $location_to, $file)
    {
        if (copy($location_from, $location_to) && ! $this->is_being_tested())
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

    /* ---------------------------------------------------------------------- */

    /**
    * Move files from one location to another
    *
    * @param string $location_from
    * @param string $location_to
    * @param string $file
    *
    * @return void
    */
    private function move_files($location_from, $location_to, $file)
    {
        if (rename($location_from, $location_to) && ! $this->is_being_tested())
        {
            $this->report['files']['number']['moved']++;
            array_push($this->report['files']['report']['moved'], $file);
        }
        else
        {
            $this->report['files']['number']['not_moved']++;
            array_push($this->report['files']['report']['not_moved'], $file);
        }
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Check if it has nothing to sort
    *
    * @return bool
    */
    private function has_nothing_to_sort()
    {
        $state = $this->operation_states();

        return empty($this->report['files']['number'][$state['1st']]) &&
            empty($this->report['files']['number'][$state['2nd']]);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Check if sorting operation is successful
    *
    * @return bool
    */
    private function is_sorting_successful()
    {
        $state = $this->operation_states();

        if ( ! $this->has_nothing_to_sort())
        {
            return empty($this->report['files']['number'][$state['2nd']]);
        }

        return FALSE;
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Deploy operation states
    *
    * @return array
    */
    private function operation_states()
    {
        switch ($this->deploy['operation'])
        {
            case 'm':
            {
                $first_state  = 'moved';
                $second_state = 'not-moved';

                break;
            }
            case 'c':
            default:
            {
                $first_state  = 'copied';
                $second_state = 'not-copied';
            }
        }

        return array(
            '1st' => $first_state,
            '2nd' => $second_state,
        );
    }

    /* ---------------------------------------------------------------------- */
}
