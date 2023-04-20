<?php
//src/Service/MessageGenerator.php
namespace App\Service;

class MessageGenerator
{
    public function getMessageCreateSuccess(): string
    {
        $messages = [
            'Cadastrado com sucesso!',
        ];

        $index = array_rand($messages);

        return $messages[$index];
    }

    public function getMessageUpdateSuccess(): string
    {
        $messages = [
            'Atualizado com sucesso!',
        ];

        $index = array_rand($messages);

        return $messages[$index];
    }

    public function getMessageAbaterSuccess(): string
    {
        $messages = [
            'Abatido com sucesso!',
        ];

        $index = array_rand($messages);

        return $messages[$index];
    }
}
