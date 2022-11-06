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
    public function testFormatsZero()
    {
        $this->assertEquals(wantedFormat(0), "0,00");
    }

    /**
     * Does it format 1 PLN correctly
     *
     * @return void
     */
    public function testFormatsUnit()
    {
        $this->assertEquals(wantedFormat(1.00), "1,00");
    }

    /**
     * Does it format 100 PLN correctly
     *
     * @return void
     */
    public function testFormatsHundred()
    {
        $this->assertEquals(wantedFormat(100), "100,00");
    }

    /**
     * Does it format 1000 PLN correctly
     *
     * @return void
     */
    public function testFormatsThousand()
    {
        $this->assertEquals(wantedFormat(1000), "1 000,00");
    }


    /**
     * Does it format 10000 PLN correctly
     *
     * @return void
     */
    public function testFormatsTenThousand()
    {
        $this->assertEquals(wantedFormat(10000.00), "10 000,00");
    }

    /**
     * Does it format 50000 with grosze PLN correctly
     *
     * @return void
     */
    public function testFormatsFiftyThousandWithGrosze()
    {
        $this->assertEquals(wantedFormat(50000.47), "50 000,47");
    }

    /**
     * Does it format 103000 with grosze PLN correctly
     *
     * @return void
     */
    public function testFormatsOneHundredAndThreeThousandWithGrosze()
    {
        $this->assertEquals(wantedFormat(103000.22), "103 000,22");
    }

    /**
     * Does it format 525002 with grosze PLN correctly
     *
     * @return void
     */
    public function testFormatsOverFiveHundredTwentyThousandThousandWithGrosze()
    {
        $this->assertEquals(wantedFormat(525002.67), "525 002,67");
    }

    /**
     * Does it format over a million with grosze PLN correctly
     *
     * @return void
     */
    public function testFormatsOverAMillionWithGrosze()
    {
        $output = wantedFormat(1427132.51);
        $this->assertEquals($output, "1 427 132,51");
        $this->assertIsString($output);
    }

    /**
     * Does it fail on non-numeric values
     *
     * @return void
     */
    public function testItFailsOnNonNumericValues()
    {
        $this->expectException(TypeError::class);
        $output = wantedFormat("String");
    }
}
