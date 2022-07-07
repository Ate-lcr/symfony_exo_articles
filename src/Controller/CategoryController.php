<?php
namespace App\Controller;


use App\Entity\Article;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Config\Doctrine\Orm\EntityManagerConfig;


class CategoryController extends AbstractController
{
    /**
     * @Route ("insert-category", name="insert_category")
     */
    //On crée un nouvel enregistrement dans la table article
    #[NoReturn] public function insertCategory(EntityManagerInterface $entityManager){
        $category = new Category();

//            J'utilise les setters pour en définir les attributs
        $category->setTitle("Titre");
        $category->setColor("Lightblue");
        $category->setDescription("Fun facts");
        $category->setisPublished(true);

//            On fait une sauvegarde(bdd) avant de faire l'inscription en bdd'
        $entityManager->persist($category);
        $entityManager->flush();

        dump($category); die;
    }


//    Affichage d'une catégorie issue de ma bdd
    /**
     * @Route("category", name="category")
     */
    public function showCategory(CategoryRepository $categoryRepository){
//        La méthode "find" me permet de récupérer un élément par la valeur que je lui passe en attribut)
        $category = $categoryRepository->find(1);
        dd($category);
    }



//    Affichage de l'ensemble des catégories de ma bdd
    /**
     * @Route("categories", name="categories")
     */
    public function showCategories (CategoryRepository $categoryRepository){
        $categories = $categoryRepository->findAll();
        dd($categories);
    }

}