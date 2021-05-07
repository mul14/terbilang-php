<?php

use Nasution\Terbilang;

class TerbilangTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Setup.
     *
     * @group Terbilang
     */
    public function setUp()
    {
        // ..
    }

    /**
     * Tear down.
     *
     * @group Terbilang
     */
    public function tearDown()
    {
        // ..
    }

    /**
     * Test for Terbilang::convert().
     *
     * @group Terbilang
     */
    public function testCanConvertNumbersIntoWords()
    {
        $this->assertEquals('nol', Terbilang::convert(0));
        $this->assertEquals('satu', Terbilang::convert(1));
        $this->assertEquals('dua', Terbilang::convert(2));
        $this->assertEquals('tiga', Terbilang::convert(3));
        $this->assertEquals('empat', Terbilang::convert(4));
        $this->assertEquals('lima', Terbilang::convert(5));
        $this->assertEquals('enam', Terbilang::convert(6));
        $this->assertEquals('tujuh', Terbilang::convert(7));
        $this->assertEquals('delapan', Terbilang::convert(8));
        $this->assertEquals('sembilan', Terbilang::convert(9));
        $this->assertEquals('sepuluh', Terbilang::convert(10));

        $this->assertEquals('sebelas', Terbilang::convert(11));
        $this->assertEquals('dua belas', Terbilang::convert(12));
        $this->assertEquals('tiga belas', Terbilang::convert(13));
        $this->assertEquals('empat belas', Terbilang::convert(14));
        $this->assertEquals('lima belas', Terbilang::convert(15));
        $this->assertEquals('enam belas', Terbilang::convert(16));
        $this->assertEquals('tujuh belas', Terbilang::convert(17));
        $this->assertEquals('delapan belas', Terbilang::convert(18));
        $this->assertEquals('sembilan belas', Terbilang::convert(19));
        $this->assertEquals('dua puluh', Terbilang::convert(20));

        $this->assertEquals('empat puluh dua', Terbilang::convert(42));
        $this->assertEquals('sembilan puluh sembilan', Terbilang::convert(99));
        $this->assertEquals('seratus', Terbilang::convert(100));
        $this->assertEquals('seratus dua puluh satu', Terbilang::convert(121));
        $this->assertEquals('lima ratus empat', Terbilang::convert(504));
        $this->assertEquals('lima ratus lima puluh empat', Terbilang::convert(554));
        $this->assertEquals('seribu', Terbilang::convert(1000));
        $this->assertEquals('dua puluh ribu', Terbilang::convert(20000));
        $this->assertEquals('satu juta', Terbilang::convert(1000000));

        $string = 'satu juta dua ratus tiga puluh empat ribu lima ratus enam puluh tujuh';
        $this->assertEquals($string, Terbilang::convert(1234567));
    }

    /**
     * Test for Terbilang::convert().
     *
     * @group Terbilang
     */
    public function testCanConvertNumbersInString()
    {
        $this->assertEquals('satu juta', Terbilang::convert('1000000'));

        $string = 'satu juta dua ratus tiga puluh empat ribu lima ratus enam puluh tujuh';
        $this->assertEquals($string, Terbilang::convert('1234567'));
    }

    /**
     * Test for Terbilang::convert().
     *
     * @group Terbilang
     */
    public function testCanConvertNumbersWithDotNotations()
    {
        $this->assertEquals('sepuluh juta', Terbilang::convert('10.000.000'));
        $this->assertEquals('seratus juta', Terbilang::convert('100.000.000'));
        $this->assertEquals('satu milyar', Terbilang::convert('1.000.000.000'));
        $this->assertEquals('satu triliun', Terbilang::convert('1.000.000.000.000'));
        $this->assertEquals('satu kuadriliun', Terbilang::convert('1.000.000.000.000.000'));
    }

    /**
     * Test for Terbilang::convert().
     *
     * @expectedException \Nasution\NotNumbersException
     * @group Terbilang
     */
    public function testShouldThrowAnErrorIfValueIsNotNumeric()
    {
        Terbilang::convert('Makan Nasi Minum Susu');
        Terbilang::convert('Makan Nasi Minum 2 Gelas Susu');
    }

    /**
     * Test for Terbilang::revert().
     *
     * @group Terbilang
     */
    public function testCanRevertWordsIntoNumbers()
    {
        $this->assertEquals(0, Terbilang::revert('nol'));
        $this->assertEquals(1, Terbilang::revert('satu'));
        $this->assertEquals(2, Terbilang::revert('dua'));
        $this->assertEquals(3, Terbilang::revert('tiga'));
        $this->assertEquals(4, Terbilang::revert('empat'));
        $this->assertEquals(5, Terbilang::revert('lima'));
        $this->assertEquals(6, Terbilang::revert('enam'));
        $this->assertEquals(7, Terbilang::revert('tujuh'));
        $this->assertEquals(8, Terbilang::revert('delapan'));
        $this->assertEquals(9, Terbilang::revert('sembilan'));
        $this->assertEquals(10, Terbilang::revert('sepuluh'));

        $this->assertEquals(11, Terbilang::revert('sebelas'));
        $this->assertEquals(12, Terbilang::revert('dua belas'));
        $this->assertEquals(13, Terbilang::revert('tiga belas'));
        $this->assertEquals(14, Terbilang::revert('empat belas'));
        $this->assertEquals(15, Terbilang::revert('lima belas'));
        $this->assertEquals(16, Terbilang::revert('enam belas'));
        $this->assertEquals(17, Terbilang::revert('tujuh belas'));
        $this->assertEquals(18, Terbilang::revert('delapan belas'));
        $this->assertEquals(19, Terbilang::revert('sembilan belas'));
        $this->assertEquals(20, Terbilang::revert('dua puluh'));

        $this->assertEquals(42, Terbilang::revert('empat puluh dua'));
        $this->assertEquals(99, Terbilang::revert('sembilan puluh sembilan'));
        $this->assertEquals(100, Terbilang::revert('seratus'));
        $this->assertEquals(121, Terbilang::revert('seratus dua puluh satu'));
        $this->assertEquals(504, Terbilang::revert('lima ratus empat'));
        $this->assertEquals(554, Terbilang::revert('lima ratus lima puluh empat'));
        $this->assertEquals(1000, Terbilang::revert('seribu'));
        $this->assertEquals(20000, Terbilang::revert('dua puluh ribu'));
        $this->assertEquals(1000000, Terbilang::revert('satu juta'));

        $string = 'satu juta dua ratus tiga puluh empat ribu lima ratus enam puluh tujuh';
        $this->assertEquals(1234567, Terbilang::revert($string));
    }

    /**
     * Test for Terbilang::revert().
     *
     * @group Terbilang
     */
    public function testRevertShouldIgnoreCaseSensitivity()
    {
        $this->assertEquals(12, Terbilang::revert('dua belas'));
        $this->assertEquals(12, Terbilang::revert('duA BeLaS'));
        $this->assertEquals(12, Terbilang::revert('DUA BELAS'));
    }

    /**
     * Test for Terbilang::revert().
     *
     * @expectedException \Nasution\NotStringsException
     * @group Terbilang
     */
    public function testShouldThrowAnErrorIfValueIsNotString()
    {
        Terbilang::revert(10);
        Terbilang::revert(true);
        Terbilang::revert(array());
        Terbilang::revert(new stdClass());
    }

    /**
     * Test for Terbilang::revert().
     *
     * @expectedException \Nasution\ContainsNonNumericWords
     * @group Terbilang
     */
    public function testShouldThrowAnErrorIfValueContainsNonNumericWords()
    {
        Terbilang::revert('ayam tiga puluh');
        Terbilang::revert('tiga ayam puluh');
        Terbilang::revert('tiga puluh ayam');
    }
}
