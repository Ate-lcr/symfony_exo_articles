<?php
namespace App\Controller;


use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Config\Doctrine\Orm\EntityManagerConfig;


class PageController extends AbstractController
{

//    Route vers liste articles après verif d'age et récupération en _GET'
//    On rajoute de quoi afficher uniquement les 3 derniers articles avec findBy
    /**
     * @Route("/age",name="ageverif")
     */
    public function age(ArticleRepository $articleRepository)
    {
        if ($_GET['id'] >=17) {
            $lastItems = $articleRepository->findBy([], ['id' => 'DESC'], 3,0);

            return $this->render('homeArticles.html.twig', [
                'lastItems' => $lastItems
            ]);
        }

        else {
            return $this->render('out.html.twig');
        }

    }


//    Route vers accueil avec formulaire de verif d'age'
    /**
     * @Route("/",name="home")
     */
    public function home(): Response
    {         return $this->render('home.html.twig');

    }






//    Anciens éléments pour la mise en place des exercices

//    public array $articles = [
//            1 => [
//                'title' => 'Non, là c\'est sale',
//                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet assumenda deserunt eius eveniet molestias necessitatibus non, quos sed sequi! Animi aspernatur assumenda earum laudantium odio quasi quibusdam quisquam veniam.',
//                'isPublished' => true,
//                'author' => 'Eric',
//                'image' => 'https://media.gqmagazine.fr/photos/5b991bbe21de720011925e1b/master/w_780,h_511,c_limit/la_tour_montparnasse_infernale_1893.jpeg',
//                'id' => 1
//            ],
//            2 => [
//                'title' => 'Il faut trouver tous les gens qui étaient de dos hier',
//                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet assumenda deserunt eius eveniet molestias necessitatibus non, quos sed sequi! Animi aspernatur assumenda earum laudantium odio quasi quibusdam quisquam veniam.',
//                'isPublished' => true,
//                'author' => 'Maurice',
//                'image' => 'https://fr.web.img6.acsta.net/r_1280_720/medias/nmedia/18/35/18/13/18369680.jpg',
//                'id' => 2
//            ],
//            3 => [
//                'title' => 'Pluuutôôôôt Braaaaaach, Vasarelyyyyyy',
//                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet assumenda deserunt eius eveniet molestias necessitatibus non, quos sed sequi! Animi aspernatur assumenda earum laudantium odio quasi quibusdam quisquam veniam.',
//                'isPublished' => true,
//                'author' => 'Didier',
//                'image' => 'https://media.gqmagazine.fr/photos/5eb02109566df9b15ae026f3/master/pass/n-3freres.jpg',
//                'id' => 3
//            ],
//            4 => [
//                'title' => 'Quand on attaque l\'empire, l\'empire contre attaque',
//                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet assumenda deserunt eius eveniet molestias necessitatibus non, quos sed sequi! Animi aspernatur assumenda earum laudantium odio quasi quibusdam quisquam veniam.',
//                'isPublished' => true,
//                'author' => 'Mbala',
//                'image' => 'https://fr.web.img2.acsta.net/newsv7/21/01/20/15/49/5077377.jpg',
//                'id' => 4
//            ],
//        ];


//    /**
//     * @Route("/list",name="list")
//     */
//    public function list(): Response
//    {
//        return $this->render('showarticles.html.twig', [
//            "articles" => $this->articles,
//        ]);
//    }


//    /**
//     * @Route("list/article/{id}", name="list_article")
//     */
//    public function listArticle ($id): Response
//    {
//        $article=$this->articles[$id];
//
//        return $this->render('showarticle.html.twig', [
//            "article" => $article
//        ]);
//    }


}