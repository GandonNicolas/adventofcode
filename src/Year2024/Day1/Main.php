<?php

namespace App\Year2024\Day1;

use App\Interface\MainInterface;

class Main implements MainInterface
{
    public function one(): int
    {
        $tableauGauche = [];
        $tableauDroite = [];
        $contenu = file_get_contents('input_1.txt', 'rb');

        $lignes = explode("\n", trim($contenu));

        // Parcourir chaque ligne
        foreach ($lignes as $ligne) {
            // Diviser la ligne en deux parties en utilisant l'espace comme séparateur
            $valeurs = explode("   ", $ligne);

            $tableauGauche[] = $valeurs[0];
            $tableauDroite[] = $valeurs[1];
        }

        sort($tableauGauche, SORT_NUMERIC);
        sort($tableauDroite, SORT_NUMERIC);

        $distance = 0;
        foreach ($tableauGauche as $key => $value) {

            if ($value <= $tableauDroite[$key]) {
                $distance += (int) $tableauDroite[$key] - (int) $value;
            } else {
                $distance += (int) $value - (int) $tableauDroite[$key];
            }
        }

        return $distance;
    }

    public function two(): int
    {
        $tableauGauche = [];
        $tableauDroite = [];

        $contenu = file_get_contents('input_1.txt', 'rb');

        $lignes = explode("\n", trim($contenu));

        // Parcourir chaque ligne
        foreach ($lignes as $ligne) {
            // Diviser la ligne en deux parties en utilisant l'espace comme séparateur
            $valeurs = explode("   ", $ligne);

            $tableauGauche[] = $valeurs[0];
            $tableauDroite[] = $valeurs[1];
        }

        $distance = 0;
        foreach ($tableauGauche as $value) {
            $occurrence = 0;
            foreach ($tableauDroite as $value2) {
                if ((int) $value === (int) $value2) {
                    ++$occurrence;
                }
            }

            if ($occurrence === 0) {
                continue;
            }

            $distance += (int) $value * $occurrence;
        }

        return $distance;
    }
}