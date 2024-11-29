<?php

namespace App\Template\DayX;

use App\Interface\MainInterface;

class Main implements MainInterface
{
    public function one(): int
    {
        $input = file_get_contents('input_1.txt', 'rb');

        return 0;
    }

    public function two(): int
    {
        $input = file_get_contents('input_1.txt', 'rb');

        return 0;
    }
}