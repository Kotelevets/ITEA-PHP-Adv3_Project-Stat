<?php

namespace App;

use App\Info\ClassInfoAnalyzer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command for getting total information about classes
 * was created by Kotyaaa <kotya.aa@gmail.com>
 *
 * Example of usage
 * ./bin/console stat:class-info 'App\Info\ClassInfoAnalyzer'
 * ./bin/console stat:class-info "App\Info\ClassInfoAnalyzer"
 * ./bin/console stat:class-info App\\Info\\ClassInfoAnalyzer
 *
 * @author Kotyaaa <kotya.aa@gmail.com>
 */
final class ClassInfoStatisticCommand extends Command
{
    private $analyzer;

    /**
     * {@inheritdoc}
     */
    public function __construct(ClassInfoAnalyzer $analyzer, string $name = null)
    {
        $this->analyzer = $analyzer;

        parent::__construct($name);
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('stat:class-info')
            ->setDescription('Shows total information about classes by full class name')
            ->addArgument(
                'fullClassName',
                InputArgument::REQUIRED,
                'Name of needed class'
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln($this->analyzer->analyze($input->getArgument('fullClassName')));
    }
}
