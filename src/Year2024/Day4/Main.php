<?php

namespace App\Year2024\Day4;

use App\Interface\MainInterface;

class Main implements MainInterface
{
    public function one(): int
    {
        $input = file_get_contents('exemple.txt', 'rb');

        $string = preg_replace('/\n/', '', $input);
        $pattern = '/XMAS|SAMX/';
        preg_match_all($pattern, $string, $matches);

        $count = \count($matches[0]);

        $grid = explode("\n", trim($input));
        // Parcourt chaque colonne
        for ($col = 0, $colMax = strlen($grid[0]); $col < $colMax; $col++) {
            $verticalString = '';

            // Construire la chaîne verticale
            foreach ($grid as $row => $rowValue) {
                $verticalString .= $grid[$row][$col];
            }

            // Chercher XMAS dans la chaîne verticale
            if (
                strpos($verticalString, 'XMAS') !== false ||
                strpos($verticalString, 'SAMX') !== false
            ) {
                $count += preg_match_all('/XMAS/', $verticalString, $match);
                $count += preg_match_all('/SAMX/', $verticalString, $match1);
            }
        }

        $rows = count($grid);
        $cols = strlen($grid[0]);

        // Compter les occurrences en diagonale
        for ($row = 0; $row < $rows; $row++) {
            for ($col = 0; $col < $cols; $col++) {
                $count += $this->checkDiagonalRight($grid, $row, $col, 'XMAS');
                $count += $this->checkDiagonalLeft($grid, $row, $col, 'XMAS');

                $count += $this->checkDiagonalRight($grid, $row, $col, 'SAMX');
                $count += $this->checkDiagonalLeft($grid, $row, $col, 'SAMX');
            }
        }
        dd($count);
        return 0;
    }

    function checkDiagonalRight($grid, $startRow, $startCol, $word) {
        $rows = count($grid);
        $cols = strlen($grid[0]);
        $count = 0;

        for ($row = $startRow, $col = $startCol;
             $row < $rows && $col < $cols;
             $row++, $col++) {
            $diagonalString = '';
            for ($i = 0; $row + $i < $rows && $col + $i < $cols; $i++) {
                $diagonalString .= $grid[$row + $i][$col + $i];
                if (strlen($diagonalString) >= 4) {
                    $count += preg_match_all("/$word/", $diagonalString);
                }
            }
        }
        return $count;
    }

    function checkDiagonalLeft($grid, $startRow, $startCol, $word) {
        $rows = count($grid);
        $cols = strlen($grid[0]);
        $count = 0;

        for ($row = $startRow, $col = $startCol; $row < $rows && $col >= 0; $row++, $col--) {
            $diagonalString = '';
            for ($i = 0; $row + $i < $rows && $col - $i >= 0; $i++) {
                $diagonalString .= $grid[$row + $i][$col - $i];
                if (strlen($diagonalString) >= 4) {
                    $count += preg_match_all("/$word/", $diagonalString);
                }
            }
        }
        return $count;
    }

    public function two(): int
    {
        $input = file_get_contents('input_1.txt', 'rb');

        return 0;
    }
}