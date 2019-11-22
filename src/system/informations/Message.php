<?php
/**
* Message
*
* Use when working with errors, warnings and informations
*
* @package      PHP_Library
* @subpackage   System
* @category     Informations
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
namespace PHP_Library\System\Informations;

/**
* Use when working with errors, warnings and informations
*/
class Message {

    /* ---------------------------------------------------------------------- */

    /**
    * Dump message
    *
    * @var array
    */
    private $message = array(
        'success' => array(),
        'error'   => array(),
        'file'    => array(),
    );

    /* ---------------------------------------------------------------------- */

    /**
    * Get all message
    *
    * @return array $this->message
    */
    public function get_message()
    {
        return $this->message;
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Get success message
    *
    * @return array $this->message['success']
    */
    public function get_success()
    {
        return $this->message['success'];
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Get error message
    *
    * @return array $this->message['error']
    */
    public function get_error()
    {
        return $this->message['error'];
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Get file message
    *
    * @return array $this->message['file']
    */
    public function get_file()
    {
        return $this->message['file'];
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Set success message
    *
    * @param string $text
    *
    * @return void
    */
    protected function set_success($text)
    {
        array_push($this->message['success'], $text);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Set error message
    *
    * @param string $text
    *
    * @return void
    */
    protected function set_error($text)
    {
        array_push($this->message['error'], $text);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Set file message
    *
    * @param string $text
    *
    * @return void
    */
    protected function set_file($text)
    {
        array_push($this->message['file'], $text);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Remove last error
    *
    * @return void
    */
    protected function pop_error()
    {
        array_pop($this->message['error']);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Check if attribute has errors
    *
    * @return bool
    */
    public function has_errors()
    {
        return ! empty($this->message['error']);
    }

    /* ---------------------------------------------------------------------- */
}
