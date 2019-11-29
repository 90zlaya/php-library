<?php
/**
* File
*
* File-related operations
*
* @package      PHP_Library
* @subpackage   Core
* @category     Files
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
namespace PHP_Library\Core\Files;

use Exception as Exception;

/**
* File-related operations
*/
class File {

    /* ---------------------------------------------------------------------- */

    /**
    * Data for image method
    *
    * @var array
    */
    public static $image = array(
        'location' => 'users/',
        'default'  => 'default.png',
    );

    /* ---------------------------------------------------------------------- */

    /**
    * Errors occured during execution
    *
    * @var array
    */
    public static $errors = array();

    /* ---------------------------------------------------------------------- */

    /**
    * Get full image link
    *
    * @param string $name
    *
    * @return string $link
    */
    public static function image($name)
    {
        $link  = self::$image['location'];
        $link .= $name;

        $image_size = FALSE;

        try
        {
            $image_size = getimagesize($link);
        }
        catch (Exception $e)
        {
            array_push(self::$errors, $e->getMessage());
        }

        if (empty($name) || ! $image_size)
        {
            $link  = self::$image['location'];
            $link .= self::$image['default'];
        }

        return $link;
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Writing data to file
    *
    * @param string $file_location
    * @param string $write_data
    * @param bool $last_in
    *
    * @return mixed
    */
    public static function write_to_file($file_location, $write_data, $last_in=TRUE)
    {
        if ( ! empty($file_location) || ! empty($write_data))
        {
            $new_data = $write_data . PHP_EOL;

            if (file_exists($file_location))
            {
                $file = fopen($file_location, 'r');

                if ( ! empty($file))
                {
                    $file_location = (string) $file_location;
                    $file_size     = (int) filesize($file_location);

                    $old_data = fread($file, $file_size);

                    $data = $last_in
                        ? $old_data . $new_data
                        : $new_data . $old_data;

                    fclose($file);

                    return self::resource_operation($file_location, $data, 'w');
                }
            }
            else
            {
                return self::resource_operation($file_location, $new_data, 'w');
            }
        }

        return FALSE;
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Reading last data item from file
    *
    * @param string $file_location
    *
    * @return mixed
    */
    public static function read_from_file($file_location)
    {
        if (file_exists($file_location))
        {
            $f = fopen($file_location, 'r');

            if ($f)
            {
                $cursor = -1;

                fseek($f, $cursor, SEEK_END);

                $char = fgetc($f);

                while ($char === "\n" || $char === "\r")
                {
                    fseek($f, $cursor--, SEEK_END);

                    $char = fgetc($f);
                }

                $line = '';

                while ($char !== FALSE && $char !== "\n" && $char !== "\r")
                {
                    $line = $char . $line;

                    fseek($f, $cursor--, SEEK_END);

                    $char = fgetc($f);
                }

                return $line;
            }
        }

        return FALSE;
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Read file contents into an array
    *
    * @param string $file_location
    * @param bool $to_unlink
    *
    * @return array
    */
    public static function read_file_contents($file_location, $to_unlink=FALSE)
    {
        $status = FALSE;
        $items  = array();

        if ( ! empty($file_location))
        {
            $status = TRUE;

            $file_contents = file($file_location);

            $to_unlink ? unlink($file_location) : NULL;

            if ( ! empty($file_contents))
            {
                foreach ($file_contents as $line)
                {
                    $items[] = explode(';', $line);
                }
            }
        }

        return array(
            'status' => $status,
            'items'  => $items,
        );
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Force file download
    *
    * @param string $url
    *
    * @return void
    */
    public static function force_download($url)
    {
        if ( ! headers_sent())
        {
            header('Content-Type: application/octet-stream');
            header('Content-Transfer-Encoding: Binary');
            header('Content-disposition: attachment; filename="' . pathinfo($url, PATHINFO_BASENAME) . '"');

            readfile($url);

            exit;
        }
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Use fopen to ensure that resource is available for operations
    *
    * @param string $file_location
    * @param string $data
    * @param string $operation
    *
    * @return int $value
    */
    private static function resource_operation($file_location, $data, $operation='w')
    {
        $value = 0;

        $resource = fopen($file_location, $operation);

        if ( ! empty($resource))
        {
            switch ($operation)
            {
                case 'w':
                {
                    $value = fwrite($resource, $data);
                }
            }
        }

        return (int) $value;
    }

    /* ---------------------------------------------------------------------- */
}
