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


    //On crée un nouvel enregistrement dans la table article
    /**
     * @Route ("insert-article", name="insert_article")
     */
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


//    Affichage d'un article de ma bdd
    /**
     * @Route("article/{id}", name="article")
     */
    public function showArticle(ArticleRepository $articleRepository, $id){
//        La méthode "find" me permet de récupérer un élément par la valeur que je lui passe en attribut)
        $article = $articleRepository->find($id);
        return $this->render('listarticle.html.twig', [
            "article" => $article
        ]);    }



//    Affichage de l'ensemble des articles de ma bdd
    /**
     * @Route("articles", name="articles")
     */
    public function showArticles (ArticleRepository $articleRepository){
        $articles = $articleRepository->findAll();
        return $this->render('list.html.twig', [
            "articles" => $articles,
        ]);
    }



}