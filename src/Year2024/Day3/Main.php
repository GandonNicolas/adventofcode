<?php

namespace App\Year2024\Day3;

use App\Interface\MainInterface;

class Main implements MainInterface
{
    public function one(): int
    {
        $input = file_get_contents('input_1.txt', 'rb');

        $pattern = '/mul\((\d{1,3}),(\d{1,3})\)/';
        preg_match_all($pattern, $input, $matches);

        $result = [];
        foreach ($matches[0] as $match) {
            $result[] = $match;
        }

        $total = 0;
        foreach ($result as $expr) {
            // Extraire les nombres de l'expression mul(x,y)
            preg_match('/mul\((\d+),(\d+)\)/', $expr, $matches);

            // Multiplier les nombres
            $result = $matches[1] * $matches[2];
            $total += $result;
        }

        return $total;
    }

    public function two(): int
    {
        $input = file_get_contents('exemple.txt', 'rb');

        $mulEnabled = true;
        $total = 0;
        // Expression régulière pour capturer do(), don't(), et mul()
        $pattern = '/do\(\)|don\'t\(\)|mul\((\d{1,3}),(\d{1,3})\)/';
        preg_match_all($pattern, $input, $matches);

        foreach ($matches[0] as $index => $match) {
            if ($match === 'do()') {
                $mulEnabled = true;
            } elseif ($match === 'don\'t()') {
                $mulEnabled = false;
            } elseif (strpos($match, 'mul(') === 0 && $mulEnabled) {
                $num1 = $matches[1][$index];
                $num2 = $matches[2][$index];
                $result = $num1 * $num2;
                $total += $result;
            }
        }

        dd($total, 'ici');
        return $total;

        return 0;
    }
}