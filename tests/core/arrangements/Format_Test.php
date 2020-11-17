<?php
/**
* Format
*
* Format related methods
*
* @package      PHP_Library
* @subpackage   Core
* @category     Arrangements
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase;
use PHP_Library\Core\Arrangements\Format;

/**
* Testing Format class
*/
class Format_Test extends TestCase {

    /* ---------------------------------------------------------------------- */

    /**
    * Testing bytes method
    */
    public function test_bytes_method()
    {
        $bytes = Format::bytes(715000, TRUE, 3);

        $this->assertNotEmpty($bytes);
        $this->assertIsArray($bytes);
        $this->assertArrayHasKey('value', $bytes);
        $this->assertArrayHasKey('sign', $bytes);
        $this->assertEquals(698.242, $bytes['value']);
        $this->assertEquals('698.242 kB', $bytes['sign']);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing query method
    */
    public function test_query_method()
    {
        $result = Format::query('SELECT name FROM table WHERE id < 10');

        $this->assertEquals(
            '<pre><code>SELECT name FROM table WHERE id &lt; 10</code></pre>',
            $result
        );
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Test telephone method
    */
    public function test_telephone_method()
    {
        $telephone = Format::telephone('012345678');

        $this->assertEquals('012/34-56-78', $telephone);

        $telephone = Format::telephone('012/34567890');

        $this->assertEquals('012/34-56-7890', $telephone);

        $telephone = Format::telephone('', '01234/567-890');

        $this->assertEquals('012/34-56-7890', $telephone);

        $telephone = Format::telephone(NULL);

        $this->assertFalse($telephone);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Test website method
    */
    public function test_website_method()
    {
        $expected  = '<a href="http://www.zlatanstajic.com"';
        $expected .= ' target="_blank" rel="noopener">zlatanstajic.com</a>';

        $result = Format::website('zlatanstajic.com');

        $this->assertIsArray($result);
        $this->assertArrayHasKey('name', $result);
        $this->assertArrayHasKey('anchor', $result);
        $this->assertEquals('http://www.zlatanstajic.com', $result['name']);
        $this->assertEquals($expected, $result['anchor']);

        $expected  = '<a href="https://www.zlatanstajic.com"';
        $expected .= ' target="_blank" rel="noopener">zlatanstajic.com</a>';

        $result = Format::website('zlatanstajic.com', TRUE);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('name', $result);
        $this->assertArrayHasKey('anchor', $result);
        $this->assertEquals('https://www.zlatanstajic.com', $result['name']);
        $this->assertEquals($expected, $result['anchor']);

        $result = Format::website(NULL);

        $this->assertFalse($result);

        $address = 'http://www.zlatanstajic.com';

        $result = Format::website($address);

        $this->assertEquals($address, $result['name']);

        $url = 'www.zlatanstajic.com';

        $result = Format::website($url);

        $this->assertEquals($address, $result['name']);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing IP method
    */
    public function test_ip_method()
    {
        $expected  = '<a href="http://www.geoplugin.net/';
        $expected .= 'php.gp?ip=172.168.150.15" target="_blank" rel="noopener">';
        $expected .= '172.168.150.15</a>';

        $result = Format::ip('172.168.150.15');

        $this->assertEquals($expected, $result);

        $localhosts = array(
            '::1',
            '127.0.0.1',
        );

        foreach ($localhosts as $localhost)
        {
            $result = Format::ip($localhost);

            $this->assertEquals('Localhost', $result);
        }

        $result = Format::ip(NULL);

        $this->assertFalse($result);
    }

    /* ---------------------------------------------------------------------- */

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
            $result = Format::title_case($item['before']);

            $this->assertEquals($item['after'], $result);
        }
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing number method
    */
    public function test_number_method()
    {
        $result = Format::number(1234567.89);

        $this->assertEquals(1.2, $result);

        $result = Format::number(1234567.89, FALSE, 1000);

        $this->assertEquals(1235, $result);

        $result = Format::number(1234567.89, FALSE);

        $this->assertEquals(1, $result);

        $result = Format::number(NULL);

        $this->assertEmpty($result);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing pre method
    */
    public function test_pre_method()
    {
        ob_start();

        $this->assertNull(Format::pre('Test'));

        ob_end_clean();
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing windows1250_to_utf8 and utf8_to_windows1250 methods
    *
    * It's considered that 'ISO-8859-2' and 'Windows-1250'
    * standards are same, therefore this assertion should work.
    */
    public function test_conversions_windows_1250_and_utf8()
    {
        $result = Format::windows1250_to_utf8('Test');

        $this->assertTrue(mb_detect_encoding($result, 'UTF-8') === 'UTF-8');

        $result = Format::utf8_to_windows1250('Test');

        $this->assertTrue(mb_detect_encoding($result, 'ISO-8859-2') === 'ISO-8859-2');
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing string method
    */
    public function test_string_method()
    {
        $string  = 'Lorem Ipsum is simply dummy text of the printing';
        $string .= ' and typesetting industry.';

        $result = Format::string($string);

        $this->assertEquals('Lorem Ipsum is ...', $result);

        $result = Format::string($string, 6, 9);

        $this->assertEquals('Ipsum is ...', $result);

        $result = Format::string($string, 6, 90);

        $this->assertEquals($string, $result);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing price_format method
    */
    public function test_price_format_method()
    {
        $result = Format::price_format(108.985);

        $this->assertEquals('108,99', $result);

        $result = Format::price_format('108.985', 3);

        $this->assertEquals('108,985', $result);

        $result = Format::price_format('108,985', 3);

        $this->assertFalse($result);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing array_to_string method
    */
    public function test_array_to_string_method()
    {
        $result = Format::array_to_string(array(
            2017,
            2018,
        ));

        $this->assertEquals('2017|2018', $result);

        $result = Format::array_to_string(array(
            2017,
            2018,
        ), ', ');

        $this->assertEquals('2017, 2018', $result);

        $result = Format::array_to_string('2017|2018');

        $this->assertEquals('', $result);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing fullname method
    */
    public function test_fullname_method()
    {
        $result = Format::fullname('John', 'Doe');

        $this->assertEquals('John Doe', $result);

        $result = Format::fullname('John', 'Doe', ' - ');

        $this->assertEquals('John - Doe', $result);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing search_wizard method
    */
    public function test_search_wizard_method()
    {
        $result = Format::search_wizard(
            'php-library',
            array(
                'name',
                'title',
                'text',
            )
        );

        $this->assertNotFalse($result);

        $result = Format::search_wizard(
            'PHP Library',
            array(
                'name',
                'title',
                'text',
            )
        );

        $this->assertNotFalse($result);

        $result = Format::search_wizard('', array());

        $this->assertFalse($result);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing language_value method
    */
    public function test_language_value_method()
    {
        $result = Format::language_value('english', 'Elephant');

        $this->assertEquals('Elephant', $result);

        $result = Format::language_value('serbian', 'Elephant', 'Slon');

        $this->assertEquals('Slon', $result);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing in_wizard method
    */
    public function test_in_wizard_method()
    {
        $result = Format::in_wizard(
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

        $result = Format::in_wizard('', array());

        $this->assertFalse($result);
    }

    /* ---------------------------------------------------------------------- */
}
