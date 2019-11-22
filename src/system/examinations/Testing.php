<?php
/**
* Testing
*
* Use when testing unreachable code
*
* @package      PHP_Library
* @subpackage   System
* @category     Examinations
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
namespace PHP_Library\System\Examinations;

use PHP_Library\System\Informations\Message as Message;

/**
* Use when testing unreachable code
*/
class Testing extends Message {

    /* ---------------------------------------------------------------------- */

    /**
    * Indicator of testing
    *
    * @var bool
    */
    private $testing = FALSE;

    /* ---------------------------------------------------------------------- */

    /**
    * Turn on testing option
    *
    * @return void
    */
    public function turn_on()
    {
        $this->testing = TRUE;
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Checks if testing option is turned on
    *
    * @return bool
    */
    protected function is_being_tested()
    {
        return $this->testing;
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Test function availability
    *
    * @param string $function_name
    *
    * @return bool
    */
    protected function is_function_available($function_name)
    {
        if ( ! function_exists($function_name) || $this->is_being_tested())
        {
            $this->set_error(
                $function_name .
                ' function disabled in PHP'
            );

            if ($this->is_being_tested())
            {
                $this->pop_error();
            }

            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    /* ---------------------------------------------------------------------- */

}
