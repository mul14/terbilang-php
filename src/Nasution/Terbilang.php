<?php namespace Nasution;

class Terbilang
{
    public function convert($number)
    {
        $number = str_replace('.', '', $number);

        $number = is_array($number) ? implode(',', $number) : $number;

        if ( ! is_numeric($number)) throw new NotNumbersException;

        $base    = array('nol', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan');
        $numeric = array('1000000000000000', '1000000000000', '1000000000000', 1000000000, 1000000, 1000, 100, 10, 1);
        $unit    = array('kuadriliun', 'triliun', 'biliun', 'milyar', 'juta', 'ribu', 'ratus', 'puluh', '');
        $str     = null;

        $i = 0;

        if ($number == 0)
        {
            $str = 'nol';
        }
        else
        {
            while ($number != 0)
            {
                $count = (int)($number / $numeric[$i]);

                if ($count >= 10)
                {
                    $str .= static::convert($count) . ' ' . $unit[$i] . ' ';
                }
                elseif ($count > 0 && $count < 10)
                {
                    $str .= $base[$count] . ' ' . $unit[$i] . ' ';
                }

                $number -= $numeric[$i] * $count;

                $i++;
            }

            $str = preg_replace('/satu puluh (\w+)/i', '\1 belas', $str);
            $str = preg_replace('/satu (ribu|ratus|puluh|belas)/', 'se\1', $str);
            $str = preg_replace('/\s{2,}/', ' ', trim($str));
        }

        return $str;
    }
}
