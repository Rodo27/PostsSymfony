<?php

namespace App\Controller;

use App\Entity\Comentario;
use App\Entity\Post;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard")
     */
    public function index(PaginatorInterface $paginator, Request $request)
    {
        $user = $this->getUser(); //Obtener al usuario logueado
        if ($user){
            $em = $this->getDoctrine()->getManager();
            $query = $em->getRepository(Post::class)->BuscarTodosLosPost();
            //$comentarios = $em->getRepository(Comentario::class)->BuscarComentarios($user->getId());
            $user->getId();
            $pagination = $paginator->paginate(
                $query,
                $request->query->getInt('page', 1), /*page number*/
                2 /*limit per page*/
            );

            return $this->render('dashboard/index.html.twig', [
                'pagination' => $pagination,
            ]);
        }else{
            return $this->redirectToRoute('app_login');
        }
    }
}
