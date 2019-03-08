<?php
/**
* Web_Service
*
* Web service related data
*
* @package      PHP_Library
* @subpackage   Core
* @category     Services
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
namespace PHP_Library\Core\Services;

use PHP_Library\System\Examinations\Testing as Testing;

/**
* Web service related data
*/
class Web_Service extends Testing {

    // -------------------------------------------------------------------------

    /**
    * Holds information about cURL availability
    *
    * @var bool
    */
    private $curl_enabled = FALSE;

    // -------------------------------------------------------------------------

    /**
    * Holds cURL session
    *
    * @var resource
    */
    private $ch;

    // -------------------------------------------------------------------------

    /**
    * Web service URL
    *
    * @var string
    */
    private $url = '';

    // -------------------------------------------------------------------------

    /**
    * Class constructor method
    *
    * @param string $url
    *
    * @return void
    */
    public function __construct($url='')
    {
        if (function_exists('curl_init'))
        {
            $this->curl_enabled = TRUE;
        }

        if ( ! empty($url))
        {
            $this->url = $url;
        }
    }

    // -------------------------------------------------------------------------

    /**
    * Set URL attribute
    *
    * @param string $url
    *
    * @return void
    */
    public function set_url($url)
    {
        if (empty($url))
        {
            $this->set_error('Please set URL');
        }
        else
        {
            $this->url = $url;
        }
    }

    // -------------------------------------------------------------------------

    /**
    * Gets response from web service
    *
    * @param array $params
    *
    * @return mixed
    */
    public function response($params=array())
    {
        $this->is_function_available('curl_init');

        if ($this->is_ready_for_initialisation())
        {
            $this->session_initialize();

            $request = $this->optional_request($params);

            $this->transfer_options($request['parameters']);

            $response = $this->session_perform();
            $code     = $this->transfer_information();

            $this->session_close();

            if ($request['is_optional'])
            {
                $response = json_decode($response, TRUE);
            }

            return array(
                'status'   => $this->convert_code($code),
                'code'     => $code,
                'response' => $response,
            );
        }

        return FALSE;
    }

    // -------------------------------------------------------------------------

    /**
    * Checks if everything is ready for cURL initalisation
    *
    * @var bool
    */
    private function is_ready_for_initialisation()
    {
        return $this->curl_enabled && ! empty($this->url);
    }

    // -------------------------------------------------------------------------

    /**
    * Initialize a cURL session and set attribute
    *
    * @return void
    */
    private function session_initialize()
    {
        $this->ch = curl_init($this->url);

        if (empty($this->ch) || $this->is_being_tested())
        {
            $this->set_error('Unable to initialize cURL handler');
        }

        if ($this->is_being_tested())
        {
            $this->pop_error();
        }
    }

    // -------------------------------------------------------------------------

    /**
    * Perform a cURL session
    *
    * @return mixed
    */
    private function session_perform()
    {
        return curl_exec($this->ch);
    }

    // -------------------------------------------------------------------------

    /**
    * Close a cURL session
    *
    * @return void
    */
    private function session_close()
    {
        curl_close($this->ch);
    }

    // -------------------------------------------------------------------------

    /**
    * Get information regarding a specific transfer
    *
    * @return mixed
    */
    private function transfer_information()
    {
        return curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
    }

    // -------------------------------------------------------------------------

    /**
    * Set an option for a cURL transfer
    *
    * @param array $params
    *
    * @return void
    */
    private function transfer_options($params)
    {
        isset($params['header'])
            ? curl_setopt($this->ch, CURLOPT_HEADER, $params['header'])
            : NULL;

        isset($params['user_agent'])
            ? curl_setopt($this->ch, CURLOPT_USERAGENT, $params['user_agent'])
            : NULL;

        isset($params['binary_transfer'])
            ? curl_setopt($this->ch, CURLOPT_BINARYTRANSFER, $params['binary_transfer'])
            : NULL;

        isset($params['custom_request'])
            ? curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, $params['custom_request'])
            : NULL;

        isset($params['post_fields'])
            ? curl_setopt($this->ch, CURLOPT_POSTFIELDS, $params['post_fields'])
            : NULL;

        isset($params['http_header'])
            ? curl_setopt($this->ch, CURLOPT_HTTPHEADER, $params['http_header'])
            : NULL;

        $return_transfer = isset($params['return_transfer'])
            ? $params['return_transfer']
            : TRUE;

        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, $return_transfer);

        $no_body = isset($params['no_body'])
            ? $params['no_body']
            : FALSE;

        curl_setopt($this->ch, CURLOPT_NOBODY, $no_body);
    }

    // -------------------------------------------------------------------------

    /**
    * Convert response code to service availability status
    *
    * @param int $code
    *
    * @return bool
    */
    private function convert_code($code)
    {
        switch ($code)
        {
            case 200: return TRUE;
            default: return FALSE;
        }
    }

    // -------------------------------------------------------------------------

    /**
    * Sending optional request
    *
    * @param array $params
    *
    * @return array
    */
    private function optional_request($params)
    {
        $is_optional = FALSE;
        $exit_array  = array();

        if (isset($params['data']))
        {
            $is_optional = TRUE;

            $data_string   = json_encode($params['data']);
            $string_length = strlen( (string) $data_string);

            $exit_array = array_merge($params, array(
                'custom_request' => 'POST',
                'post_fields'    => $data_string,
                'http_header'    => array(
                    'Content-Type: application/json',
                    'Content-Length: ' . $string_length,
                ),
            ));
        }
        else
        {
            $exit_array = $params;
        }

        return array(
            'is_optional' => $is_optional,
            'parameters'  => $exit_array,
        );
    }

    // -------------------------------------------------------------------------
}
