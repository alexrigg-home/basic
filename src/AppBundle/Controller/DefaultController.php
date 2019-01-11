<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    
    // public function indexAction(Request $request)
    // {
    //     // replace this example code with whatever you need
    //     return $this->render('default/index.html.twig', [
    //         'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
    //     ]);
    // }

    /**
     * @Route("/", name="basic")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        $now = intval(date('Y'));
        $start = 1999;
        
        return $this->render('blog/basic.html.twig', [
            'nav' => 'basic',
            'navcat' => 'blog',
            'years' => ($now - $start),
        ]);
    }


    /**
     * @Route("/charts", name="charts")
     */
    public function chartsAction(Request $request)
    {
        // replace this example code with whatever you need
        $now = intval(date('Y'));
        $start = 1999;
        
        return $this->render('blog/charts.html.twig', [
            'nav' => 'charts',
            'navcat' => 'blog',            
        ]);
    }

    /**
     * @Route("/howsetup", name="howsetup")
     */
    public function howsetupAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('how/howsetup.html.twig', [
            'nav' => 'howsetup',
            'navcat' => 'how',
        ]);
    }


     /**
     * @Route("/info", name="info")
     */
    public function infoAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('blog/index.html.twig', [
            'nav' => 'info',
            'navcat' => 'blog',
        ]);
    }
}
