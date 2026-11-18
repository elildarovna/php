<?php

namespace App\Service;

class SiteLanguage
{
    private const DEFAULT_LANGUAGE = 'ru';
    private const ALLOWED_LANGUAGES = ['ru', 'en'];

    public function __construct(private readonly string $stateFile)
    {
    }

    public function get(): string
    {
        if (!is_file($this->stateFile)) {
            return self::DEFAULT_LANGUAGE;
        }

        $language = trim((string) file_get_contents($this->stateFile));

        return in_array($language, self::ALLOWED_LANGUAGES, true)
            ? $language
            : self::DEFAULT_LANGUAGE;
    }

    public function set(string $language): bool
    {
        if (!in_array($language, self::ALLOWED_LANGUAGES, true)) {
            return false;
        }

        $directory = dirname($this->stateFile);
        if (!is_dir($directory)) {
            mkdir($directory, 0775, true);
        }

        return file_put_contents($this->stateFile, $language, LOCK_EX) !== false;
    }
}
