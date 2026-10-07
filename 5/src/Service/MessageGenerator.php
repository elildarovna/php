<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\Attribute\Autowire;

class MessageGenerator
{
    public function __construct(
        private PersonalGreetingGenerator $personalGreetingGenerator,
        #[Autowire(param: 'app.return_address')]
        private string $returnAddress,
        #[Autowire(param: 'kernel.project_dir')]
        private string $projectDir,
    ) {
    }

    public function generate(array $users): array
    {
        $messages = $this->personalGreetingGenerator->generate($users);
        $messagesDir = $this->projectDir.'/var/messages';

        if (!is_dir($messagesDir)) {
            mkdir($messagesDir, 0777, true);
        }

        $createdMessages = [];

        foreach ($messages as $index => $message) {
            $fileName = sprintf('message_%s_%d.txt', date('Ymd_His'), $index + 1);
            $filePath = $messagesDir.'/'.$fileName;
            $content = implode(PHP_EOL, [
                'Обратный адрес: '.$this->returnAddress,
                'Кому: '.$message['email'],
                'Тема: Приветствие',
                '',
                $message['greeting'],
            ]).PHP_EOL;

            if (file_put_contents($filePath, $content) === false) {
                continue;
            }

            $createdMessages[] = [
                'name' => $message['name'],
                'email' => $message['email'],
            ];
        }

        return [
            'count' => count($createdMessages),
            'messages' => $createdMessages,
        ];
    }
}
