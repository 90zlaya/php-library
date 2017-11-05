<?php
/*
| -------------------------------------------------------------------
| MATH
| -------------------------------------------------------------------
|
| Mathematical operations and calculations
|
| -------------------------------------------------------------------
*/
namespace phplibrary;

class Math{
    
    // -------------------------------------------------------------------------
    
    /**
    * Calculate percentage between two numbers
    * 
    * @param int $smaller_number
    * @param int $larger_number
    * 
    * @return Array $data
    */
    public function percentage($smaller_number, $larger_number)
    {
        if(empty($smaller_number) || empty($larger_number))
        {
            $percentage = 0;    
        }
        else
        {
            $percentage = (100 * $smaller_number) / $larger_number;
        }
        
        $data = array(
            'value' => $percentage,
            'sign'  => $percentage . '%',
        );
        
        return $data;
    }
    
    // -------------------------------------------------------------------------
}
?>