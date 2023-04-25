<?php

namespace App\Service;

use App\Entity\Animal;
use DateTime;

class AnimalService
{

    #metodo para verificar se animal pode ser abatido#
    public function verificaAnimalAbate(Animal $animal)
    {
        $interval = $animal->getDtNasc()->diff( new DateTime( date('Y-m-d') ) );
        $idade = $interval->format( '%Y anos' );

        if ((($animal->getPeso() > 270) || ($animal->getQtdleite() < 40) || ($animal->getQtdleite() < 70 && ($animal->getQtdracao()/7) > 50) || ($idade > 5)) && $animal->isStatus()==0) {
            return true;
        }

            return false;
    }

    
}
