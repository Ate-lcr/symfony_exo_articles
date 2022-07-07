<?php
namespace App\Controller;


use App\Entity\Article;
use App\Entity\Category;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Config\Doctrine\Orm\EntityManagerConfig;


class ArticleController extends AbstractController
{

    /**
     * @Route ("insert-article", name="insert_article")
     */
    //On crée un nouvel enregistrement dans la table article
    #[NoReturn] public function insertArticle(EntityManagerInterface $entityManager){
        $article = new article();

//            J'utilise les setters pour en définir les attributs
        $article->setTitle("Titre");
        $article->setContent("lorem ipsum");
        $article->setIsPublished(true);
        $article->setAuthor("Me,myself and I");

//            On fait une sauvegarde(bdd) avant de faire l'inscription en bdd'
        $entityManager->persist($article);
        $entityManager->flush();

        dump($article); die;
    }


    /**
     * @Route("article", name="article")
     */
    public function showArticle(ArticleRepository $articleRepository){
//        La méthode "find" me permet de récupérer un élément par la valeur que je lui passe en attribut)
        $article = $articleRepository->find(1);
        dd($article);
    }


    /**
     * @Route("articles", name="articles")
     */
    public function showArticles (ArticleRepository $articleRepository){
        $articles = $articleRepository->findAll();
        dd($articles);
    }

}