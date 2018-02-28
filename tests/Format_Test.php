<?php
/**
* Format
*
* Format related methods
*
* @package      PHP Library
* @subpackage   phplibrary
* @category     Format
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase as Test_Case;
use phplibrary\Format as format;

/**
* Testing Format class
*/
class Format_Test extends Test_Case {
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing bytes method
    */
    public function test_bytes_method()
    {
        $bytes = format::bytes(715000, TRUE, 3);
        
        $this->assertNotEmpty($bytes);
        $this->assertInternalType('array', $bytes);
        $this->assertArrayHasKey('value', $bytes);
        $this->assertArrayHasKey('sign', $bytes);
        $this->assertEquals(698.242, $bytes['value']);
        $this->assertEquals('698.242 kB', $bytes['sign']);
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing query method
    */
    public function test_query_method()
    {
        $result = format::query('SELECT name FROM table WHERE id < 10');
        
        $this->assertEquals(
            '<pre><code>SELECT name FROM table WHERE id &lt; 10</code></pre>',
            $result
        );
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Test telephone method
    */
    public function test_telephone_method()
    {
        $telephone = format::telephone('012345678');
        
        $this->assertEquals('012/34-56-78', $telephone);
        
        $telephone = format::telephone('012/34567890');
        
        $this->assertEquals('012/34-56-7890', $telephone);
        
        $telephone = format::telephone('', '01234/567-890');
        
        $this->assertEquals('012/34-56-7890', $telephone);
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Test website method
    */
    public function test_website_method()
    {
        $result = format::website('zlatanstajic.com');
        
        $this->assertInternalType('array', $result);
        $this->assertArrayHasKey('name', $result);
        $this->assertArrayHasKey('anchor', $result);
        $this->assertEquals('http://www.zlatanstajic.com', $result['name']);
        $this->assertEquals('<a href="http://www.zlatanstajic.com" target="_blank">zlatanstajic.com</a>', $result['anchor']);
        
        $result = format::website('zlatanstajic.com', TRUE);
        
        $this->assertInternalType('array', $result);
        $this->assertArrayHasKey('name', $result);
        $this->assertArrayHasKey('anchor', $result);
        $this->assertEquals('https://www.zlatanstajic.com', $result['name']);
        $this->assertEquals('<a href="https://www.zlatanstajic.com" target="_blank">zlatanstajic.com</a>', $result['anchor']);
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing IP method
    */
    public function test_ip_method()
    {
        $result = format::ip('172.168.150.15');
        
        $this->assertEquals('<a href="http://www.geoplugin.net/php.gp?ip=172.168.150.15" target="_blank">172.168.150.15</a>', $result);
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing title_case method
    */
    public function test_title_case_method()
    {
        $list_of_parameters = array(
            array(
                'before' => 'one',
                'after'  => 'One',
            ),
            array(
                'before' => 'one thousand',
                'after'  => 'One thousand',
            ),
            array(
                'before' => '1 thousand',
                'after'  => '1 thousand',
            ),
        );
        
        foreach ($list_of_parameters as $item)
        {
            $result = format::title_case($item['before']);
        
            $this->assertEquals($item['after'], $result);
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing number method
    */
    public function test_number_method()
    {
        $result = format::number(1234567.89);
        
        $this->assertEquals(1.2, $result);
        
        $result = format::number(1234567.89, FALSE, 1000);
        
        $this->assertEquals(1235, $result);
        
        $result = format::number(1234567.89, FALSE);
        
        $this->assertEquals(1, $result);
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing pre method
    */
    public function test_pre_method()
    {
        ob_start();
        
        $this->assertNull(format::pre('Test'));
        
        ob_end_clean();
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing windows1250_to_utf8 and utf8_to_windows1250 methods
    * 
    * It's considered that 'ISO-8859-2' and 'Windows-1250'
    * standards are same, therefore this assertion should work.
    */
    public function test_conversions_windows_1250_and_utf8()
    {
        $result = format::windows1250_to_utf8('Test');
        
        $this->assertTrue(mb_detect_encoding($result, 'UTF-8') === 'UTF-8');
        
        $result = format::utf8_to_windows1250('Test');
        
        $this->assertTrue(mb_detect_encoding($result, 'ISO-8859-2') === 'ISO-8859-2');
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing string method
    */
    public function test_string_method()
    {
        $string  = 'Lorem Ipsum is simply dummy text of the printing';
        $string .= ' and typesetting industry.';
        
        $result = format::string($string);
        
        $this->assertEquals('Lorem Ipsum is ...', $result);
        
        $result = format::string($string, 6, 9);
        
        $this->assertEquals('Ipsum is ...', $result);
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing price_format method
    */
    public function test_price_format_method()
    {
        $result = format::price_format(108.985);
        
        $this->assertEquals('108,99', $result);
        
        $result = format::price_format('108.985', 3);
        
        $this->assertEquals('108,985', $result);
        
        $result = format::price_format('108,985', 3);
        
        $this->assertFalse($result);
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing array_to_string method
    */
    public function test_array_to_string_method()
    {
        $result = format::array_to_string(array(
            2017,
            2018,
        ));
        
        $this->assertEquals('2017|2018', $result);
        
        $result = format::array_to_string(array(
            2017,
            2018,
        ), ', ');
        
        $this->assertEquals('2017, 2018', $result);
        
        $result = format::array_to_string('2017|2018');
        
        $this->assertEquals('', $result);
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing fullname method
    */
    public function test_fullname_method()
    {
        $result = format::fullname('John', 'Doe');
        
        $this->assertEquals('John Doe', $result);
        
        $result = format::fullname('John', 'Doe', ' - ');
        
        $this->assertEquals('John - Doe', $result);
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing search_wizard method
    */
    public function test_search_wizard_method()
    {
        $result = format::search_wizard(
            'php-library',
            array(
                'name',
                'title',
                'text',
            )
        );
        
        $this->assertNotFalse($result);
        
        $result = format::search_wizard('', array());
        
        $this->assertFalse($result);
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing language_value method
    */
    public function test_language_value_method()
    {
        $result = format::language_value('english', 'Elephant');
        
        $this->assertEquals('Elephant', $result);
        
        $result = format::language_value('serbian', 'Elephant', 'Slon');
        
        $this->assertEquals('Slon', $result);
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Testing in_wizard method
    */
    public function test_in_wizard_method()
    {
        $result = format::in_wizard(
            'field',
            array(
                'first',
                'second',
                'third',
            )
        );
        
        $this->assertEquals(
            ' AND field IN ("first", "second", "third")',
            $result
        );
        
        $result = format::in_wizard('', array());
        
        $this->assertFalse($result);
    }
    
    // -------------------------------------------------------------------------
}
