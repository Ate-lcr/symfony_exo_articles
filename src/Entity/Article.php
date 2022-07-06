<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */


//On crée dans Entity nos classes correspondant aux tables
//On fait le mapping des $variables de cette classe qui corresponderont aux éléments de la table lié à cette entité.

class Article
{
//    Concernant l'ID on utilise les 3 commandes suivantes pour le définir en primary key/autogenerate de type INT
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="string")
     */
    public $title;

}

//Pour créer le fichier de migration
//"php bin/console make:migration"
//
//
//pour le comparer avec ka bdd et faire les modifications
//"php bin/console doctrine:migration:migrate"