<?php

namespace Tests\Unit;

use Tests\TestCase;
use TypeError;

use function App\wantedFormat;

class FormatHelperTest extends TestCase
{
    /**
     * Does it format zero value correctly
     *
     * @return void
     */
    public function test_formats_zero()
    {
        $this->assertEquals(wantedFormat(0), '0,00');
    }

    /**
     * Does it format 1 PLN correctly
     *
     * @return void
     */
    public function test_formats_unit()
    {
        $this->assertEquals(wantedFormat(1.00), '1,00');
    }

    /**
     * Does it format 100 PLN correctly
     *
     * @return void
     */
    public function test_formats_hundred()
    {
        $this->assertEquals(wantedFormat(100), '100,00');
    }

    /**
     * Does it format 1000 PLN correctly
     *
     * @return void
     */
    public function test_formats_thousand()
    {
        $this->assertEquals(wantedFormat(1000), '1 000,00');
    }

    /**
     * Does it format 10000 PLN correctly
     *
     * @return void
     */
    public function test_formats_ten_thousand()
    {
        $this->assertEquals(wantedFormat(10000.00), '10 000,00');
    }

    /**
     * Does it format 50000 with grosze PLN correctly
     *
     * @return void
     */
    public function test_formats_fifty_thousand_with_grosze()
    {
        $this->assertEquals(wantedFormat(50000.47), '50 000,47');
    }

    /**
     * Does it format 103000 with grosze PLN correctly
     *
     * @return void
     */
    public function test_formats_one_hundred_and_three_thousand_with_grosze()
    {
        $this->assertEquals(wantedFormat(103000.22), '103 000,22');
    }

    /**
     * Does it format 525002 with grosze PLN correctly
     *
     * @return void
     */
    public function test_formats_over_five_hundred_twenty_thousand_thousand_with_grosze()
    {
        $this->assertEquals(wantedFormat(525002.67), '525 002,67');
    }

    /**
     * Does it format over a million with grosze PLN correctly
     *
     * @return void
     */
    public function test_formats_over_a_million_with_grosze()
    {
        $output = wantedFormat(1427132.51);
        $this->assertEquals($output, '1 427 132,51');
        $this->assertIsString($output);
    }

    /**
     * Does it fail on non-numeric values
     *
     * @return void
     */
    public function test_it_fails_on_non_numeric_values()
    {
        $this->expectException(TypeError::class);
        $output = wantedFormat('String');
    }
}
