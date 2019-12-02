<?php
/**
* Date_Time_Format
*
* Date and Time formating, validating, comparing, converting...
*
* @package      PHP_Library
* @subpackage   Core
* @category     Arrangements
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
use PHPUnit\Framework\TestCase;
use PHP_Library\Core\Arrangements\Date_Time_Format;

/**
* Testing Date_Time_Format class
*/
class Date_Time_Format_Test extends TestCase {

    /* ---------------------------------------------------------------------- */

    /**
    * Testing types public property
    */
    public function test_types_public_property()
    {
        $names = array(
            'user',
            'database',
            'friendly',
            'unfriendly',
        );

        $this->assertClassHasAttribute('types', Date_Time_Format::class);
        $this->assertNotEmpty(Date_Time_Format::$types);
        $this->assertIsArray(Date_Time_Format::$types);

        foreach ($names as $name)
        {
            $this->assertArrayHasKey($name, Date_Time_Format::$types);
        }
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Comparing current method return values
    * for multiple formats input
    */
    public function test_current_method()
    {
        $this->assertEquals(
            date(Date_Time_Format::$types['unfriendly']['datetime']),
            Date_Time_Format::current()
        );

        $parameter = Date_Time_Format::$types['friendly']['datetime'];

        $this->assertEquals(
            date($parameter),
            Date_Time_Format::current($parameter)
        );
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing compare method return values
    * for different dates
    */
    public function test_compare_method()
    {
        $this->assertTrue(Date_Time_Format::compare('31.12.2017'));
        $this->assertFalse(Date_Time_Format::compare('31.12.2037'));
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing return values of format, format_to_database,
    * and format_to_user methods.
    */
    public function test_format_methods()
    {
        $result = Date_Time_Format::format('01.01.2018', TRUE);

        $this->assertEquals('01-Jan-2018', $result);

        $result = Date_Time_Format::format_to_database('01.01.2018');

        $this->assertEquals('2018-01-01', $result);

        $result = Date_Time_Format::format_to_user('2018-01-01');

        $this->assertEquals('01.01.2018', $result);

        $result = Date_Time_Format::format_to_database('01.01.1970');

        $this->assertFalse($result);

        $result = Date_Time_Format::format_to_user('1970-01-01');

        $this->assertFalse($result);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing minutes_to_hours method
    */
    public function test_minutes_to_hours_method()
    {
        $hours = Date_Time_Format::minutes_to_hours(555);

        $this->assertEquals('09:15', $hours);

        $hours = Date_Time_Format::minutes_to_hours(-555);

        $this->assertEquals('00:00', $hours);

        $hours = Date_Time_Format::minutes_to_hours('nothing');

        $this->assertFalse($hours);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing hours_to_minutes method
    */
    public function test_hours_to_minutes_method()
    {
        $minutes = Date_Time_Format::hours_to_minutes('09:15');

        $this->assertEquals(555, $minutes);

        $minutes = Date_Time_Format::hours_to_minutes('09-15');

        $this->assertEmpty($minutes);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing number_to_day method for various input
    */
    public function test_number_to_day_method()
    {
        $day = Date_Time_Format::number_to_day(5);

        $this->assertEquals('petak', $day);

        $day = Date_Time_Format::number_to_day(1, 'english');

        $this->assertEquals('monday', $day);

        $day = Date_Time_Format::number_to_day(6, 'serbian', FALSE);

        $this->assertEquals('Subota', $day);

        $false_values = array(
            'nothing',
            -5,
            0,
            8,
        );

        foreach ($false_values as $value)
        {
            $day = Date_Time_Format::number_to_day($value);

            $this->assertFalse($day);
        }
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing number_to_month method for various input
    */
    public function test_number_to_month_method()
    {
        $month = Date_Time_Format::number_to_month(5);

        $this->assertEquals('maj', $month);

        $month = Date_Time_Format::number_to_month(1, 'english');

        $this->assertEquals('january', $month);

        $month = Date_Time_Format::number_to_month(9, 'serbian', FALSE);

        $this->assertEquals('Septembar', $month);

        $false_values = array(
            'nothing',
            -5,
            0,
            13,
        );

        foreach ($false_values as $value)
        {
            $month = Date_Time_Format::number_to_month($value);

            $this->assertFalse($month);
        }
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing prefix method
    */
    public function test_prefix_method()
    {
        $string = 'phpunit';

        $result = Date_Time_Format::prefix($string);

        $this->assertEquals(date('YmdHis') . '_' . $string, $result);

        $result = Date_Time_Format::prefix('');

        $this->assertFalse($result);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing date_from_jmbg method for various input
    */
    public function test_date_from_jmbg_method()
    {
        $date = Date_Time_Format::date_from_jmbg('2609970123456');

        $this->assertEquals('26. 9. 1970.', $date);

        $false_values = array(
            'nothing',
            -5,
            0,
            13,
        );

        foreach ($false_values as $value)
        {
            $date = Date_Time_Format::date_from_jmbg($value);

            $this->assertFalse($date);
        }

        $date = Date_Time_Format::date_from_jmbg('0910990123456');

        $this->assertEquals('9. 10. 1990.', $date);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing first_day_of_year method for various input
    */
    public function test_first_day_of_year_method()
    {
        $day = Date_Time_Format::first_day_of_year('l', 2018);

        $this->assertEquals('Monday', $day);

        $false_values = array(
            -5,
            13,
            'x',
            'nothing',
        );

        foreach ($false_values as $value)
        {
            $day = Date_Time_Format::first_day_of_year($value);

            $this->assertFalse($day);
        }
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing days_before method for various input
    */
    public function test_days_before_method()
    {
        $number_of_days = 10;

        $result = Date_Time_Format::days_before($number_of_days);

        $formula = date('Y-m-d', strtotime(' -' . $number_of_days . ' day'));

        $this->assertEquals($formula, $result);

        $false_values = array(
            '',
        );

        foreach ($false_values as $value)
        {
            $day = Date_Time_Format::days_before($value);

            $this->assertFalse($day);
        }

        $result = Date_Time_Format::days_before($number_of_days, 'd-m-Y');

        $this->assertNotFalse($result);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing days_after method for various input
    */
    public function test_days_after_method()
    {
        $number_of_days = 10;

        $result = Date_Time_Format::days_after($number_of_days);

        $formula = date('Y-m-d', strtotime(' +' . $number_of_days . ' day'));

        $this->assertEquals($formula, $result);

        $false_values = array(
            '',
        );

        foreach ($false_values as $value)
        {
            $day = Date_Time_Format::days_after($value);

            $this->assertFalse($day);
        }

        $result = Date_Time_Format::days_after($number_of_days, 'Y-m-d');

        $this->assertEquals($formula, $result);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing get_days method for various input
    */
    public function test_get_days_method()
    {
        $days = Date_Time_Format::get_days();

        $this->assertIsArray($days);
        $this->assertArrayHasKey('php', $days);
        $this->assertArrayHasKey('json', $days);
        $this->assertNotEmpty($days['php']);
        $this->assertNotEmpty($days['json']);
        $this->assertEquals(7, count($days['php']));
        $this->assertJsonStringEqualsJsonString(
            $days['json'],
            json_encode($days['php'])
        );

        $days = Date_Time_Format::get_days(NULL, 3);

        $this->assertNotEmpty($days);
    }

    /* ---------------------------------------------------------------------- */

    /**
    * Testing get_months method for various input
    */
    public function test_get_months_method()
    {
        $months = Date_Time_Format::get_months();

        $this->assertIsArray($months);
        $this->assertArrayHasKey('php', $months);
        $this->assertArrayHasKey('json', $months);
        $this->assertNotEmpty($months['php']);
        $this->assertNotEmpty($months['json']);
        $this->assertEquals(12, count($months['php']));
        $this->assertJsonStringEqualsJsonString(
            $months['json'],
            json_encode($months['php'])
        );

        $months = Date_Time_Format::get_months(NULL, 3);

        $this->assertNotEmpty($months);
    }

    /* ---------------------------------------------------------------------- */
}
