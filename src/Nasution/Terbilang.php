<?php

namespace Nasution;

use SplStack;

class Terbilang
{
    private static $reverts = array(
        'nol' => '0',
        'satu' => '1',
        'dua' => '2',
        'tiga' => '3',
        'empat' => '4',
        'lima' => '5',
        'enam' => '6',
        'tujuh' => '7',
        'delapan' => '8',
        'sembilan' => '9',
        'sebelas' => '11',
        'dua belas' => '12',
        'tiga belas' => '13',
        'empat belas' => '14',
        'lima belas' => '15',
        'enam belas' => '16',
        'tujuh belas' => '17',
        'delapan belas' => '18',
        'sembilan belas' => '19',
        'dua puluh' => '20',
        'tiga puluh' => '30',
        'empat puluh' => '40',
        'lima puluh' => '50',
        'enam puluh' => '60',
        'tujuh puluh' => '70',
        'delapan puluh' => '80',
        'sembilan puluh' => '90',
        'puluh' => '10',
        'ratus' => '100',
        'ribu' => '1000',
        'juta' => '1000000',
        'milyar' => '1000000000',
        'biliun' => '1000000000000',
        'triliun' => '1000000000000',
        'kuadriliun' => '1000000000000000',
    );

    public static function convert($number)
    {
        $number = str_replace('.', '', $number);

        if (! is_numeric($number)) {
            throw new NotNumbersException();
        }

        $base = array(
            'nol',
            'satu',
            'dua',
            'tiga',
            'empat',
            'lima',
            'enam',
            'tujuh',
            'delapan',
            'sembilan');
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

    /**
     * Revert back terbilang's result into it's numeric value.
     *
     * @param string $words
     *
     * @return float
     */
    public static function revert($words)
    {
        if (! is_string($words)) {
            throw new NotStringsException(sprintf(
                'Only string are supported for conversion, %s given.',
                gettype($words)
            ));
        }

        $words = trim(strtolower($words));
        $words = preg_replace('/\s+/', ' ', $words);
        $words = preg_replace(
            '/se(kuadriliun|triliun|biliun|milyar|juta|ribu|ratus|puluh)/',
            'satu \1',
            $words
        );
        $words = strtr($words, static::$reverts);

        $parts = explode(' ', $words);
        $parts = array_map(function ($word) {
            // sanity check :)
            if (! in_array($word, static::$reverts)) {
                throw new ContainsNonNumericWords(sprintf(
                    'Given string contains non-numeric words: %s',
                    $word
                ));
            }

            return (float) $word;
        }, $parts);

        $stack = new SplStack();
        $output = 0;
        $remaining = null;

        foreach ($parts as $part) {
            if (! $stack->isEmpty()) {
                if ($stack->top() > $part) {
                    if ($remaining >= 1000) {
                        $output += $stack->pop();
                        $stack->push($part);
                    } else {
                        $stack->push($stack->pop() + $part);
                    }
                } else {
                    $stack->push($stack->pop() * $part);
                }
            } else {
                $stack->push($part);
            }

            $remaining = $part;
        }

        $output += $stack->pop();

        return $output;
    }
}
