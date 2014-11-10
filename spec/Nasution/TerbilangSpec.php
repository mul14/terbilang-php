<?php namespace spec\Nasution;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TerbilangSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Nasution\Terbilang');
    }

    function it_can_convert_numbers_into_words()
    {
        $this->convert(0)->shouldReturn('nol');
        $this->convert(1)->shouldReturn('satu');
        $this->convert(2)->shouldReturn('dua');
        $this->convert(3)->shouldReturn('tiga');
        $this->convert(4)->shouldReturn('empat');
        $this->convert(5)->shouldReturn('lima');
        $this->convert(6)->shouldReturn('enam');
        $this->convert(7)->shouldReturn('tujuh');
        $this->convert(8)->shouldReturn('delapan');
        $this->convert(9)->shouldReturn('sembilan');
        $this->convert(10)->shouldReturn('sepuluh');

        $this->convert(11)->shouldReturn('sebelas');
        $this->convert(12)->shouldReturn('dua belas');
        $this->convert(13)->shouldReturn('tiga belas');
        $this->convert(14)->shouldReturn('empat belas');
        $this->convert(15)->shouldReturn('lima belas');
        $this->convert(16)->shouldReturn('enam belas');
        $this->convert(17)->shouldReturn('tujuh belas');
        $this->convert(18)->shouldReturn('delapan belas');
        $this->convert(19)->shouldReturn('sembilan belas');
        $this->convert(20)->shouldReturn('dua puluh');

        $this->convert(42)->shouldReturn('empat puluh dua');

        $this->convert(99)->shouldReturn('sembilan puluh sembilan');

        $this->convert(100)->shouldReturn('seratus');

        $this->convert(121)->shouldReturn('seratus dua puluh satu');

        $this->convert(504)->shouldReturn('lima ratus empat');

        $this->convert(554)->shouldReturn('lima ratus lima puluh empat');

        $this->convert(1000)->shouldReturn('seribu');

        $this->convert(20000)->shouldReturn('dua puluh ribu');

        $this->convert(1000000)->shouldReturn('satu juta');

        $this->convert(1234567)->shouldReturn('satu juta dua ratus tiga puluh empat ribu lima ratus enam puluh tujuh');
    }

    function it_can_convert_numbers_in_string()
    {
        $this->convert('1000000')->shouldReturn('satu juta');
        $this->convert('1234567')->shouldReturn('satu juta dua ratus tiga puluh empat ribu lima ratus enam puluh tujuh');
    }

    function it_can_convert_numbers_with_dot_notations()
    {
        $this->convert('10.000.000')->shouldReturn('sepuluh juta');

        $this->convert('100.000.000')->shouldReturn('seratus juta');

        $this->convert('1.000.000.000')->shouldReturn('satu milyar');

        $this->convert('1.000.000.000.000')->shouldReturn('satu triliun');

        $this->convert('1.000.000.000.000.000')->shouldReturn('satu kuadriliun');
    }

    function it_should_thown_an_error_if_value_is_not_numeric()
    {
        $this->shouldThrow('Nasution\NotNumbersException')->duringConvert('Makan Nasi Minum Susu');
    }
}
