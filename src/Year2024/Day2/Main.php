<?php

namespace App\Year2024\Day2;

use App\Interface\MainInterface;

class Main implements MainInterface
{
    private const ASC = 'asc';
    private const DESC = 'desc';

    public function one(): int
    {
        // $input = file_get_contents('input_1.txt', 'rb');
        $input = file_get_contents('input_1.txt', 'rb');

        $lignes = explode("\n", trim($input));

        $nbSafe = 0;

        foreach ($lignes as $line) {
            $valeurs = explode(" ", $line);

            if ($valeurs[0] === $valeurs[1]) {
                continue;
            }

            $sort = $valeurs[0] > $valeurs[1] ? self::DESC : self::ASC;
            $safe = true;

            foreach ($valeurs as $key => $valeur) {
                $nextKey = (int) $key + 1;

                if (!array_key_exists($nextKey, $valeurs)) {
                    break;
                }

                $nextVal = (int) $valeurs[$nextKey];

                if ($sort === self::DESC && (int) $valeur < $nextVal) {
                    $safe = false;
                    break;
                }

                if ($sort === self::ASC && (int)$valeur > $nextVal) {
                    $safe = false;
                    break;
                }

                $diff = abs($valeur - $nextVal);

                if ($diff < 1 || $diff > 3) {
                    $safe = false;
                    break;
                }
            }

            if ($safe) {
                ++$nbSafe;
            }
        }

        return $nbSafe;
    }

    public function two(): int
    {
        $input = file_get_contents('input_1.txt', 'rb');

        return 0;
    }
}
