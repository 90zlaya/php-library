<?php
/**
* Breadcrumbs for navigation
*/
class Breadcrumbs{

    // -------------------------------------------------------------------------    
    
    /**
    * Breadcrumbs for page
    * 
    * @param int $full_code
    * 
    * @return $breadcrumbs
    */
    public function breadcrumbs($full_code) 
    {
        $breadcrumbs = array();
        $depth = strlen($full_code) / 4;
        if($depth > 0)
        {
            $counter = 1;

            while($depth > 0)
            {
                $length = $counter * 4; 
                $page_code = substr($full_code, 0, $length);

                $query = "
                    SELECT na.name, 
                        na.name_serbian, 
                        na.url
                    FROM cms.cms_navigation na
                    WHERE code = '$page_code'
                    limit 1;
                ";
                $result = $this->db->query($query);
                $sql = $result->result_array();
                if(!empty($sql))
                {
                    $data = $result->row_array();
                    
                    $breadcrumbs[] = array(
                        'url'  => $data['url'],
                        'name' => $data['name_serbian'],
                    );
                } 

                $depth--;
                $counter++;
            }
        }

        return $breadcrumbs;
    }
    
    // -------------------------------------------------------------------------
}
?>    