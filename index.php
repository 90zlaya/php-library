<?php
/*
| -------------------------------------------------------------------
| INDEX PAGE
| -------------------------------------------------------------------
| This file contains default view for testing classes.
|
| You may instantiate classes here, call methods and pass parameters
| to and from methods in purpose of testing and developing.
|
| -------------------------------------------------------------------
*/
echo 'This is index page.<br/><br/>';

require_once('classes/directory-lister.php');

$directory = 'D:/Browser/images/';
$files = Directory_Lister::files($directory);
print_r('<pre>');
print_r($files);
print_r('</pre>');

$delimiter = '1457618897445-1042036105';
$search = Directory_Lister::search($files, $delimiter);
print_r('<pre>');
print_r($search);
print_r('</pre>');

/*
$mime_types = array(
    'png',
    'jpg',
);
$items = Directory_Lister::display($search, $mime_types);
foreach($items as $item)
{
    echo $item;
}
*/


////////////////////////////////////////////////////////////////////////////////
    // -------------------------------------------------------------------------    
    /**
    * Breadcrumbs for page
    * 
    * @param int $full_code
    * 
    * @return $breadcrumbs
    */
    /*
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
    */
////////////////////////////////////////////////////////////////////////////////
    