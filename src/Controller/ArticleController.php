<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Article;
use App\Form\CommentFormType;
use App\Message\CommentMessage;
use App\Repository\CommentRepository;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ArticleController extends AbstractController
{
    private $twig;
    private $entityManager;
    private $bus;

    public function __construct(Environment $twig, EntityManagerInterface $entityManager, MessageBusInterface $bus)
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
        $this->bus = $bus;
    }
    /**
     * @Route("/", name="homepage")
     */
    public function index(ArticleRepository $articleRepository): Response
     {
        return new Response($this->twig->render('article/index.html.twig', [
                        'articles' => $articleRepository->findAll(),
                    ]));
             }

    /**
     * @Route("/typing", name="typing")
     */
    public function typing(ArticleRepository $articleRepository): Response
     {
        return new Response($this->twig->render('article/typing.html.twig', [
                        'articles' => $articleRepository->findAll(),
                    ]));
             }
            
    /**
     * @Route("/article/{slug}", name="article")
     */
    public function show(Request $request, Article $article, ArticleRepository $articleRepository, CommentRepository $commentRepository, NotifierInterface $notifier): Response
     {
        $comment = new Comment();
        $form = $this->createForm(CommentFormType::class, $comment);
        $form->handleRequest($request);
       if ($form->isSubmitted() && $form->isValid()) {
           $comment->setArticle($article);

           $this->entityManager->persist($comment);
           $this->entityManager->flush();

           $context = [
                'user_ip' => $request->getClientIp(),
                'user_agent' => $request->headers->get('user-agent'),
                'referrer' => $request->headers->get('referer'),
                'permalink' => $request->getUri(),
            ];
            $this->bus->dispatch(new CommentMessage($comment->getId(), $context));
            
            $notifier->send(new Notification('Thank you for the feedback; your comment will be posted after moderation.', ['browser']));

           return $this->redirectToRoute('article', ['slug' => $article->getSlug()]);
       }

       if ($form->isSubmitted()) {
                    $notifier->send(new Notification('Can you check your submission? There are some problems with it.', ['browser']));
                }

        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $commentRepository->getCommentPaginator($article, $offset);

        
       
        return new Response($this->twig->render('article/show.html.twig', [
            'articles' => $articleRepository->findAll(),
            'article' => $article,
            'comments' => $paginator,
            'previous' => $offset - CommentRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($paginator), $offset + CommentRepository::PAGINATOR_PER_PAGE),
            'comment_form' => $form->createView(),
        ]));
    }

    public function showPostUpdate(NotifierInterface $notifier, ArticleRepository $articleRepository): Response
    {         
     $this->entityManager->flush();
     $notifier->send(new Notification('There are updated articles available.', ['browser']));
    
     return new Response($this->twig->render('article/index.html.twig', [
        'articles' => $articleRepository->findAll(),
    ]));
  

    }
 }
