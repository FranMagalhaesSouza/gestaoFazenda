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

    public function getMessageUpdateError(): string
    {
        $messages = [
            'Animal  abatido não pode ser editado!',
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

    public function getMessageAbaterError(): string
    {
        $messages = [
            'Animal não pode ser abatido',
        ];

        $index = array_rand($messages);

        return $messages[$index];
    }
    public function getMessageDeleteSuccess(){
        $messages = [
            'Excluído com sucesso!',
        ];

        $index = array_rand($messages);

        return $messages[$index];
    }

    public function getMessageDeleteError(): string
    {
        $messages = [
            'Animal abatido não pode ser excluido',
        ];

        $index = array_rand($messages);

        return $messages[$index];
    }


    
}
