<?php
namespace App\Controller;


use App\Entity\Article;
use App\Entity\Category;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Config\Doctrine\Orm\EntityManagerConfig;


class AdminCategoryController extends AbstractController
{
    /**
     * @Route ("/admin/insert-category", name="admin_insert_category")
     */
    //On crée un nouvel enregistrement dans la table article
    #[NoReturn] public function insertCategory(EntityManagerInterface $entityManager){
        $category = new Category();

//            J'utilise les setters pour en définir les attributs
        $category->setTitle("Eco");
        $category->setColor("Lightgreen");
        $category->setDescription("Ecology");
        $category->setisPublished(true);

//            On fait une sauvegarde(bdd) avant de faire l'inscription en bdd'
        $entityManager->persist($category);
        $entityManager->flush();

        $this->addFlash('success', "Vous avez bien créé une catégorie!");
        return $this->redirectToRoute('admin_categories');
    }


//    Affichage d'une catégorie issue de ma bdd
    /**
     * @Route("/admin/category/{id}", name="admin_category")
     */
    public function showCategory(CategoryRepository $categoryRepository,$id){
//        La méthode "find" me permet de récupérer un élément par la valeur que je lui passe en attribut)
        $category = $categoryRepository->find($id);
        return $this->render('admin/showcategory.html.twig', [
            "category" => $category
        ]);}


//    Affichage de l'ensemble des catégories de ma bdd
    /**
     * @Route("/admin/categories", name="admin_categories")
     */
    public function showCategories (CategoryRepository $categoryRepository){
        $categories = $categoryRepository->findAll();
        return $this->render('admin/showcategories.html.twig', [
            "categories" => $categories,
        ]);
    }


    /**
     * @Route ("/admin/category/delete/{id}", name="admin_delete_category")
     */
    #[NoReturn] public function deleteCategory(CategoryRepository $categoryRepository, $id, EntityManagerInterface $entityManager){
        $category = $categoryRepository->find($id);

        if (!is_null($category)) {
            $entityManager->remove($category);
            $entityManager->flush();
            $this->addFlash('success', "Vous avez bien supprimé cette catégorie!");
            return $this->redirectToRoute('admin_categories');

        } else {
            $this->addFlash('success', "Cette catégorie est déjà supprimée!");
            return $this->redirectToRoute('admin_categories');
        }
    }
}