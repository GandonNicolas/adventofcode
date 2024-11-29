<?php

namespace App\Command;

use App\Exception\ClassNotFoundException;
use App\Interface\MainInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Helper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RunCommand extends Command
{
    private int $year;
    private int $day;

    protected function configure()
    {
        $this->setName('advent:run')
            ->addArgument(
                'day',
                InputArgument::REQUIRED,
            )
             ->addArgument(
                 'year',
                 InputArgument::OPTIONAL,
             )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->year = $input->getArgument('year') ?? date('Y');
        $this->day = $input->getArgument('day');

        $io = new SymfonyStyle($input, $output);

        $className = "App\\Year$this->year\\Day$this->day\\Main";

        $class = $this->getClass($className);

        try {
            $io->table(['PARTIE 1', 'PARTIE 2'], [[$class->one(), $class->two()]]);
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $error = $e->getMessage();
            $banner = sprintf(
                '<error>%s</>',
                str_repeat(' ', Helper::width(Helper::removeDecoration($io->getFormatter(), $error)))
            );

            $io->text([
                $banner,
                $error,
                $banner,
                '',
            ]);
        }

        return Command::FAILURE;
    }

    private function getClass(string $className): MainInterface
    {
        return class_exists($className) ?
            new $className($this->day) :
            throw new ClassNotFoundException(
                sprintf('There is no class available for day %s', $this->day)
            );
    }
}