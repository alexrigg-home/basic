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
     * @Route("/worldnews", name="worldnews")
    */
    public function worldnewsAction(Request $request)
    {
        // replace this example code with whatever you need
       $seismic=simplexml_load_file('http://www.bgs.ac.uk/feeds/WorldSeismology.xml');          

       return $this->render('blog/worldnews.html.twig', [
            'nav' => 'worldnews',
            'navcat' => 'blog',
            'seismic' => $seismic
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
            'data' => array(43934, 24916, 11744, 0, 12908)
        );
        $series[] = Array(
            'name' => 2016,
            'data' => Array(52503, 24064, 17722, 0, 5948)
        );
        $series[] = Array(
            'name' => 2017,
            'data' => Array(57177, 29742, 16005, 7988, 8105)
        );
        $series[] = Array(
            'name' => 2018,
            'data' => Array(69658, 29851, 19771, 12169, 11248)
        );
        // manipulations should be done outside the view - and in a helper or something...

        //linegraph
        $lineseries = array();       
        foreach($series as $serieskey => $data)        
        {                        
            foreach($data as $key=>$dataseries)
            {               
                foreach($categories as $catkey => $cat)
                {
                    if ( !array_key_exists($catkey,$lineseries) ) $lineseries[$catkey] = array();
                    if ( !array_key_exists('name',$lineseries[$catkey]) ) $lineseries[$catkey]['name'] = $cat;
                    if ( !array_key_exists('data',$lineseries[$catkey])) $lineseries[$catkey]['data'] = array();                    
                    
                    if ( $key == 'data' )
                    {                                                                            
                        $lineseries[$catkey]['data'][$serieskey]=intval($dataseries[$catkey]);
                    }
                }                        
            }
        }
       

        //line graph       
        $lineOutput = array();
        foreach($lineseries as $data)
        {
            $linedata = array();
            foreach($data as $key=>$dataseries)   
            if ( $key == 'name' ) 
            {
                $linedata['name'] =$dataseries;
            } else {
                $linedata['data'] =json_encode($dataseries);
            }
            $lineOutput[] = $linedata;
        }
       

        //pie chart
        $pieOutput = array();
        $total = 0;
        foreach($lineseries as $data)
        {
            $piedata = array();
            foreach($data as $key=>$dataseries)   
            if ( $key == 'name' ) 
            {
                $piedata['name'] =$dataseries;
            } else {
                $piedata['data'] =0;
                foreach ($dataseries as $datavalue)
                {
                    $piedata['data']+= $datavalue;
                }
                $total+= $piedata['data'];
            }            
            $pieOutput[] = $piedata;
        }
        // no division by 0
        if ( $total > 0 )
        {
            foreach($pieOutput as $pieKey => $piepiece)
            {             
                $pieOutput[$pieKey]['data'] = ($pieOutput[$pieKey]['data'] / $total) * 100;
            }
        }
       

        //bargraph
        $barcat = json_encode($categories);
        $barOutput = array();
        foreach($series as $data)
        {
            $bardata = array();
            foreach($data as $key=>$dataseries)   
            if ( $key == 'name' ) 
            {
                $bardata['name'] =$dataseries;
            } else {
                $bardata['data'] =json_encode($dataseries);
            }
            $barOutput[] = $bardata;
        }

        return $this->render('blog/charts.html.twig', [
            'nav' => 'charts',
            'navcat' => 'blog',
            'pieseries' => $pieOutput,
            'lineseries'=>$lineOutput,
            'barcat' => $barcat,
            'barseries' => $barOutput            
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
     * @Route("/howgraphs", name="howgraphs")
     */
    public function howgraphsAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('how/howgraphs.html.twig', [
            'nav' => 'howgraphs',
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
