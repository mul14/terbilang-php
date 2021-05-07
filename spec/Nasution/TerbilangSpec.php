<?php

namespace spec\Nasution;

use PhpSpec\ObjectBehavior;

class TerbilangSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Nasution\Terbilang');
    }

    public function it_can_convert_numbers_into_words()
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

    public function it_can_convert_numbers_in_string()
    {
        $this->convert('1000000')->shouldReturn('satu juta');
        $this->convert('1234567')->shouldReturn('satu juta dua ratus tiga puluh empat ribu lima ratus enam puluh tujuh');
    }

    public function it_can_convert_numbers_with_dot_notations()
    {
        $this->convert('10.000.000')->shouldReturn('sepuluh juta');

        $this->convert('100.000.000')->shouldReturn('seratus juta');

        $this->convert('1.000.000.000')->shouldReturn('satu milyar');

        $this->convert('1.000.000.000.000')->shouldReturn('satu triliun');

        $this->convert('1.000.000.000.000.000')->shouldReturn('satu kuadriliun');
    }

    public function it_should_thown_an_error_if_value_is_not_numeric()
    {
        $this->shouldThrow('Nasution\NotNumbersException')->duringConvert('Makan Nasi Minum Susu');
    }

    /**
     * Spec for Terbilang::revert().
     *
     * @return void
     */
    public function it_can_revert_words_into_numbers()
    {
        $this->convert('nol')->shouldReturn(0);
        $this->revert('satu')->shouldReturn(1);
        $this->revert('dua')->shouldReturn(2);
        $this->revert('tiga')->shouldReturn(3);
        $this->revert('empat')->shouldReturn(4);
        $this->revert('lima')->shouldReturn(5);
        $this->revert('enam')->shouldReturn(6);
        $this->revert('tujuh')->shouldReturn(7);
        $this->revert('delapan')->shouldReturn(8);
        $this->revert('sembilan')->shouldReturn(9);
        $this->revert('sepuluh')->shouldReturn(10);

        $this->revert('sebelas')->shouldReturn(11);
        $this->revert('dua belas')->shouldReturn(12);
        $this->revert('tiga belas')->shouldReturn(13);
        $this->revert('empat belas')->shouldReturn(14);
        $this->revert('lima belas')->shouldReturn(15);
        $this->revert('enam belas')->shouldReturn(16);
        $this->revert('tujuh belas')->shouldReturn(17);
        $this->revert('delapan belas')->shouldReturn(18);
        $this->revert('sembilan belas')->shouldReturn(19);
        $this->revert('dua puluh')->shouldReturn(20);

        $this->revert('empat puluh dua')->shouldReturn(42);

        $this->revert('sembilan puluh sembilan')->shouldReturn(99);

        $this->revert('seratus')->shouldReturn(100);

        $this->revert('seratus dua puluh satu')->shouldReturn(121);

        $this->revert('lima ratus empat')->shouldReturn(504);

        $this->revert('lima ratus lima puluh empat')->shouldReturn(554);

        $this->revert('seribu')->shouldReturn(1000);

        $this->revert('dua puluh ribu')->shouldReturn(20000);

        $this->revert('satu juta')->shouldReturn(1000000);

        $this->revert('satu juta dua ratus tiga puluh empat ribu lima ratus enam puluh tujuh')
            ->shouldReturn(1234567);
    }

    /**
     * Spec for Terbilang::revert().
     *
     * @return void
     */
    public function it_should_ignore_case_sensitivity()
    {
        $this->convert('dua belas')->shouldReturn(12);
        $this->convert('duA BeLaS')->shouldReturn(12);
        $this->convert('DUA BELAS')->shouldReturn(12);
    }

    /**
     * Spec for Terbilang::revert().
     *
     * @return void
     */
    public function it_should_thown_an_error_if_value_is_not_string()
    {
        $this->shouldThrow('Nasution\NotStringsException')->duringRevert(10);
        $this->shouldThrow('Nasution\NotStringsException')->duringRevert(true);
        $this->shouldThrow('Nasution\NotStringsException')->duringRevert([]);
        $this->shouldThrow('Nasution\NotStringsException')->duringRevert(new stdClass());
    }

    /**
     * Spec for Terbilang::revert().
     *
     * @return void
     */
    public function it_should_thown_an_error_if_value_contains_non_numeric_words()
    {
        $this->shouldThrow('Nasution\ContainsNonNumericWords')->duringRevert('ayam tiga puluh');
        $this->shouldThrow('Nasution\ContainsNonNumericWords')->duringRevert('tiga ayam puluh');
        $this->shouldThrow('Nasution\ContainsNonNumericWords')->duringRevert('tiga puluh ayam');
    }
}
