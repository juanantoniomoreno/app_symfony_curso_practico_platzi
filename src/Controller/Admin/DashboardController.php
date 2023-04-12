<?php

namespace App\Controller\Admin;


use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Post;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(PostCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Aplicación');
    }

    public function configureMenuItems(): iterable
    {
        //yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);

        yield MenuItem::linkToCrud('Categorías',    'fas fa-folder', Category::class);
        yield MenuItem::linkToCrud('Publicaciones', 'fas fa-cloud', Post::class);
        yield MenuItem::linkToCrud('Comentarios',   'fas fa-comments', Comment::class);

        yield MenuItem::linkToRoute('Sitio Web',    'fa fa-home', 'app_home');
    }
}
