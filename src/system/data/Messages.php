<?php
/**
* Messages
*
* Use when working with errors, warnings and informations
*
* @package      PHP_Library
* @subpackage   System
* @category     Data
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
namespace PHP_Library\System\Data;

/**
* Use when working with errors, warnings and informations
*/
class Messages {

    // -------------------------------------------------------------------------

    /**
    * Dump messages
    *
    * @var array
    */
    private $messages = array(
        'success' => array(),
        'error'   => array(),
        'file'    => array(),
    );

    // -------------------------------------------------------------------------

    /**
    * Get all messages
    *
    * @return array $this->messages
    */
    public function get_messages()
    {
        return $this->messages;
    }

    // -------------------------------------------------------------------------

    /**
    * Get success messages
    *
    * @return array $this->messages['success']
    */
    public function get_success()
    {
        return $this->messages['success'];
    }

    // -------------------------------------------------------------------------

    /**
    * Get error messages
    *
    * @return array $this->messages['error']
    */
    public function get_error()
    {
        return $this->messages['error'];
    }

    // -------------------------------------------------------------------------

    /**
    * Get file messages
    *
    * @return array $this->messages['file']
    */
    public function get_file()
    {
        return $this->messages['file'];
    }

    // -------------------------------------------------------------------------

    /**
    * Set success message
    *
    * @param string $text
    *
    * @return void
    */
    protected function set_success($text)
    {
        array_push($this->messages['success'], $text);
    }

    // -------------------------------------------------------------------------

    /**
    * Set error message
    *
    * @param string $text
    *
    * @return void
    */
    protected function set_error($text)
    {
        array_push($this->messages['error'], $text);
    }

    // -------------------------------------------------------------------------

    /**
    * Set file message
    *
    * @param string $text
    *
    * @return void
    */
    protected function set_file($text)
    {
        array_push($this->messages['file'], $text);
    }

    // -------------------------------------------------------------------------

    /**
    * Remove last error
    *
    * @return void
    */
    protected function pop_error()
    {
        array_pop($this->messages['error']);
    }

    // -------------------------------------------------------------------------

    /**
    * Check if attribute has errors
    *
    * @return bool
    */
    protected function has_errors()
    {
        return ! empty($this->messages['error']);
    }

    // -------------------------------------------------------------------------
}
