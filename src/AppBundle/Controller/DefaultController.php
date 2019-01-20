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
        
        //example data
        $categories = Array('London', 'New York', 'Paris', 'Berlin', 'Moscow');    
        $series[] = Array(
            'name' => 2015,
            'data' => json_encode(array(43934, 24916, 11744, null, 12908))
        );
        $series[] = Array(
            'name' => 2016,
            'data' =>  json_encode(Array(52503, 24064, 17722, null, 5948))
        );
        $series[] = Array(
            'name' => 2017,
            'data' => json_encode(Array(57177, 29742, 16005, 7988, 8105))
        );
        $series[] = Array(
            'name' => 2018,
            'data' => json_encode(Array(69658, 29851, 19771, 12169, 11248))
        );

        return $this->render('blog/charts.html.twig', [
            'nav' => 'charts',
            'navcat' => 'blog',
            'cat' => json_encode($categories),
            'series' => $series            
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

    /**
     * @Route("/about", name="about")
    */
    public function aboutAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('blog/aboutme.html.twig', [
            'nav' => 'about',
            'navcat' => 'blog',
        ]);
    }
}
