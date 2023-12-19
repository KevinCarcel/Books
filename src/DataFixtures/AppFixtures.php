<?php

namespace App\DataFixtures;

use App\Entity\Book;
use App\Entity\Author;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //création des auteurs.
        $listAuthor = [];
        for ($i=0; $i < 10; $i++) { 
            //création de l'auteur lui-meme.
            $author = new Author ();
            $author->setFirstName("Prénom " . $i);
            $author->setLastName("Nom " . $i);
            $manager->persist($author);
            //on sauvegarde l'auteur créé dans un tableau.
            $listAuthor[] = $author;
        }
        // Création d'une vingtaine de livres ayant pour titre
        for ($i = 0; $i < 20; $i++) {
            $livre = new Book;
            $livre->setTitle('Livre '  . $i);
            $livre->setCoverText('Quatrième de couverture numéro :
            ' . $i);
            //on lie le livre a un auteur pris au hasard dans le tableau des auteurs.
            $livre->setAuthor($listAuthor[array_rand($listAuthor)]);
            $manager->persist($livre);
        }
        
            $manager->flush();
    }
    
}