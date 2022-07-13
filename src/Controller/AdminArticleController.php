<?php
namespace App\Controller;


use App\Entity\Article;
use App\Entity\Category;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Config\Doctrine\Orm\EntityManagerConfig;


class AdminArticleController extends AbstractController
{


//    //On crée un nouvel enregistrement dans la table article
//    /**
//     * @Route ("/admin/insert-article", name="admin_insert_article")
//     */
//    #[NoReturn] public function insertArticle(EntityManagerInterface $entityManager){
//        $article = new article();



////            J'utilise les setters pour en définir les attributs
//        $article->setTitle($_GET['title']);
//        $article->setContent($_GET['content']);
//        $article->setIsPublished(true);
//        $article->setAuthor($_GET['author']);
//
////            On fait une sauvegarde(bdd) avant de faire l'inscription en bdd'
//        $entityManager->persist($article);
//        $entityManager->flush();
//
//        $this->addFlash('success', "Vous avez bien ajouté l'article!");
//        return $this->redirectToRoute('admin_articles');
//    }


//    Affichage d'un article de ma bdd
    /**
     * @Route("/admin/article/{id}", name="admin_article")
     */
    public function showArticle(ArticleRepository $articleRepository, $id){
//        La méthode "find" me permet de récupérer un élément par la valeur que je lui passe en attribut)
        $article = $articleRepository->find($id);
        return $this->render('admin/showarticle.html.twig', [
            "article" => $article
        ]);    }



//    Affichage de l'ensemble des articles de ma bdd
    /**
     * @Route("/admin/articles", name="admin_articles")
     */
    public function showArticles (ArticleRepository $articleRepository){
        $articles = $articleRepository->findAll();
        return $this->render('admin/showarticles.html.twig', [
            "articles" => $articles,
        ]);
    }



    //On supprime un article à l'aide de son id
    //Mélange de ArticleRepository pour le sélectionner puis EntityManager pour le supprimer.
    /**
     * @Route ("/admin/article/delete/{id}", name="admin_delete_article")
     */
    #[NoReturn] public function deleteArticle(ArticleRepository $articleRepository, $id, EntityManagerInterface $entityManager){
        $article = $articleRepository->find($id);

        if (!is_null($article)) {
            $entityManager->remove($article);
            $entityManager->flush();
            $this->addFlash('success', "Vous avez bien supprimé l'article!");
            return $this->redirectToRoute('admin_articles');

        } else {
            $this->addFlash('success', "Cet article est déjà supprimé!");
            return $this->redirectToRoute('admin_articles');
        }
    }

    //On modifie (update) un article à l'aide de son id
    //Mélange de ArticleRepository pour le sélectionner puis EntityManager pour le modifier.
    /**
     * @Route ("/admin/article/update/{id}", name="admin_update_article")
     */
    public function updateArticle(ArticleRepository $articleRepository, $id, EntityManagerInterface $entityManager, Request $request)
    {
        $article = $articleRepository->find($id);
        $form = $this->createform(ArticleType::class, $article);

//        On donne à la variable qui contient le formulaire une instance de la classe Request pour que le formulaire
//        puisse récupérer toutes les données des inputs et faire les setters sur les articles automatiquement
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($article);
            $entityManager->flush();

            $this->addFlash('success', "Article enregistré!");
        }

        return $this->render("admin/createarticle.html.twig", [
            'form' => $form->createview()

        ]);
    }


        /**
     * @Route ("/admin/create", name="admin_create")
     */
    public function createArticles (Request $request, EntityManagerInterface $entityManager)
    {
        $article = new article();
        $form=$this->createform(ArticleType::class, $article);

//        On donne à la variable qui contient le formulaire une instance de la classe Request pour que le formulaire
//        puisse récupérer toutes les données des inputs et faire les setters sur les articles automatiquement
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($article);
            $entityManager->flush();

            $this->addFlash('success', "Article enregistré!");
        }

        return $this->render("admin/createarticle.html.twig", [
            'form'=> $form->createview()

        ]);

    }

    /**
     * @Route("/admin/articles/search", name="admin_search_articles")
     */
    public function searchArticles(Request $request, ArticleRepository $articleRepository)
    {
        // je récupère les valeurs de mon form de recherche
        $search = $request->query->get('search');

        // je crée dans ArticleRepo ma méthode pour rechercher d'après un mot
        $articles = $articleRepository->searchByWord($search);

        // on refait passer ces éléments dans un nouveau fichier twig qui les affichera
        return $this->render('admin/search_articles.html.twig', [
            'articles' => $articles
        ]);
    }


    }