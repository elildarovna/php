<?php

namespace App\Command;

use App\Service\SiteLanguage;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:language:change',
    description: 'Changes the language of the whole website for every visitor.'
)]
class ChangeLanguageCommand extends Command
{
    public function __construct(private readonly SiteLanguage $siteLanguage)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument(
            'language',
            InputArgument::REQUIRED,
            'Language code: ru or en'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $language = strtolower((string) $input->getArgument('language'));

        if (!in_array($language, ['ru', 'en'], true)) {
            $output->writeln('<error>Choose ru or en.</error>');

            return Command::INVALID;
        }

        if (!$this->siteLanguage->set($language)) {
            $output->writeln('<error>Could not save the language setting.</error>');

            return Command::FAILURE;
        }

        $languageName = $language === 'ru' ? 'Russian' : 'English';
        $output->writeln(sprintf('Website language changed to %s (%s).', $languageName, $language));

        return Command::SUCCESS;
    }
}
