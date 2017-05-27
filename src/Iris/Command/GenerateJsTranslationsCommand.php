<?php

namespace Iris\Command;

use DirectoryIterator;
use Iris\Iris;
use Loader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateJsTranslationsCommand extends Command
{

    /**
     * @var Loader
     */
    protected $loader;

    protected function configure()
    {
        $this
            ->setName('iris:generate-js-translations')
            ->setDescription('Generate translation files for JS from PHP files for Gulp')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->loader = Iris::$app->getContainer()->get('loader');

        $languages = $this->getListOfLanguages();

        if (count($languages) === 0) {
            $output->writeln('<comment>Translations were not found.</comment>');
            return;
        }

        $this->generateJsForEveryLanguage($languages);

        $output->writeln('<info>Generated files for next languages: ' . implode(', ', $languages). '.</info>');
    }

    /**
     * @return string[]
     */
    protected function getListOfLanguages()
    {
        $languages = [];
        foreach ($this->loader->getHierarchy() as $item) {
            if (!is_dir($item['directory'] . 'language')) {
                continue;
            }
            foreach (new DirectoryIterator($item['directory'] . 'language') as $fileInfo) {
                if ($fileInfo->isDot() || !$fileInfo->isDir()) {
                    continue;
                }
                $languages[$fileInfo->getFilename()] = $fileInfo->getFilename();
            }
        }
        return $languages;
    }

    /**
     * @param string[] $languages
     */
    protected function generateJsForEveryLanguage($languages)
    {
        $tmpLanguageDir = Iris::$app->getBuildDir() . 'language';
        if (!is_dir($tmpLanguageDir)) {
            mkdir($tmpLanguageDir);
        }

        foreach ($languages as $language) {
            $file = $this->loader->getFileName('language/' . $language . '/' . $language . '.php');
            if (!$file) {
                continue;
            }
            $translations = require $file;
            $data = 'T.mergeWith('
                . json_encode($translations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
                . ');' . PHP_EOL;

            if (!is_dir($tmpLanguageDir . '/' . $language)) {
                mkdir($tmpLanguageDir . '/' . $language);
            }

            file_put_contents($tmpLanguageDir . '/' . $language . '/' . $language . '.js', $data);
        }
    }
}