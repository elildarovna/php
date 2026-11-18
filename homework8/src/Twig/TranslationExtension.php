<?php

namespace App\Twig;

use App\Service\TextCatalog;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TranslationExtension extends AbstractExtension
{
    public function __construct(private readonly TextCatalog $textCatalog)
    {
    }

    public function getFilters(): array
    {
        return [new TwigFilter('t', [$this->textCatalog, 'translate'])];
    }
}
