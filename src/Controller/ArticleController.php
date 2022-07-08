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
        $article->setTitle("Fifth article");
        $article->setContent("Who let's the dogs out ?");
        $article->setIsPublished(true);
        $article->setAuthor("Do you really think someone is needed for that ?");

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
        return $this->render('showarticle.html.twig', [
            "article" => $article
        ]);    }



//    Affichage de l'ensemble des articles de ma bdd
    /**
     * @Route("articles", name="articles")
     */
    public function showArticles (ArticleRepository $articleRepository){
        $articles = $articleRepository->findAll();
        return $this->render('showarticles.html.twig', [
            "articles" => $articles,
        ]);
    }



    //On supprime un article à l'aide de son id
    //Mélange de ArticleRepository pour le sélectionner puis EntityManager pour le supprimer.
    /**
     * @Route ("article/delete/{id}", name="delete_article")
     */
    #[NoReturn] public function deleteArticle(ArticleRepository $articleRepository, $id, EntityManagerInterface $entityManager){
        $article = $articleRepository->find($id);

        if (!is_null($article)) {
            $entityManager->remove($article);
            $entityManager->flush();
            dump('article supprimé');
            die;
        } else {
            dump('article déjà supprimé');
            die;
        }
    }

    //On modifie (update) un article à l'aide de son id
    //Mélange de ArticleRepository pour le sélectionner puis EntityManager pour le modifier.
    /**
     * @Route ("article/update/{id}", name="update_article")
     */
    public function updateArticle(ArticleRepository $articleRepository, $id, EntityManagerInterface $entityManager){
        $article = $articleRepository->find($id);
        $article->setTitle("updated article");
        $article->setContent("Who let's the cats out ?");
        $article->setIsPublished(true);
        $article->setAuthor("Probably someone");

//            On fait une sauvegarde(bdd) avant de faire l'inscription en bdd'
        $entityManager->persist($article);
        $entityManager->flush();
        dump('article modifié');
        die;
    }


}