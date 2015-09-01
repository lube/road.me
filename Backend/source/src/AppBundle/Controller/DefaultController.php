<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\DoctrineBundle\ConnectionFactory;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;

use AppBundle\Entity\Punto;
use AppBundle\Entity\Tramo;

class DefaultController extends Controller
{
    public function getTramoAction(Request $request)
    {
        try{
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository("AppBundle:Tramo");
            $serializer = $this->get('jms_serializer');
            $json_object = $this->get('request')->request->all();

            $norte     = $json_object['norte'];
            $sur       = $json_object['sur'];
            $oeste     = $json_object['oeste'];
            $este      = $json_object['este'];

            $qb = $em->createQueryBuilder();
            $qb->select('t', 'p')
                    ->from('AppBundle:Tramo', 't')
                    ->join('t.puntos', 'p')
                    ->where($qb->expr()->gte('p.lng', $oeste))
                    ->andWhere($qb->expr()->lte('p.lng', $este))
                    ->andWhere($qb->expr()->gte('p.lat', $sur))
                    ->andWhere($qb->expr()->lte('p.lat', $norte));

            $query = $qb->getQuery();
            $itemsPage = $query->getArrayResult();
            
            $jsonContent = $serializer->serialize($itemsPage, 'json', SerializationContext::create());
            
            $response = new Response($jsonContent);     
            return $response;
            
        } catch (Exception $ex) {

        }
    }

    public function updateTestAction(Request $request)
    {
        try{
            $serializer = $this->get('jms_serializer');
            
            $em = $this->getDoctrine()->getManager();
            $repoPuntos   = $em->getRepository("AppBundle:Punto");
            $repoTramos   = $em->getRepository("AppBundle:Tramo");

            $connectionFactory = $this->container->get('doctrine.dbal.connection_factory');
            $conn = $connectionFactory->createConnection(array(
                'driver' => 'pdo_pgsql',
                'user' => 'osm',
                'password' => '12341234',
                'host' => 'localhost',
                'dbname' => 'osm',
            ))->prepare('select id, tags, nodes from ways limit 1;');;

            $conn->execute();

         //   $jsonContent = $serialraw[0]izer->serialize(, 'json', SerializationContext::create());
            
            foreach ($conn->fetchAll() as $way) {
                if (isset($way['tags'])) {
                    $raw = explode(',', $way['tags']);
               
                    if (strpos($raw[0], 'name')) {
                        $pre = stripslashes(stripslashes($raw[0]));
                        $ways[] = array('id' => $way['id'],'name' => substr($pre, 9, -1), 'nodes' =>  explode(',',str_replace(array('{','}'), array('',''), $way['nodes']))) ;
                    }
                }

            }

            foreach ($ways as $way) {
                foreach ($way['nodes'] as $j => $point) {
                    $conn = $connectionFactory->createConnection(array(
                        'driver' => 'pdo_pgsql',
                        'user' => 'osm',
                        'password' => '12341234',
                        'host' => 'localhost',
                        'dbname' => 'osm',
                    ))->prepare('select id, ST_x(geom), ST_y(geom) from nodes where id ='. $point .';');;

                    $conn->execute();

                    $result = $conn->fetchAll();
                    $nodos[] = $result[0];
                }

                $t = new Tramo();
                $t->setEstado('TN');
                $t->setId($way['id']);
                $t->setNombre($way['name']);


                foreach ($nodos as $nodo) {
                    $someNodo = $repoPuntos->find($nodo['id']);
                    if ($someNodo) {
                        $t->addPunto($someNodo);
                        $em->merge($someNodo);
                    }
                    else {
                        $p = new Punto();
             
                        $p->setLat((float)$nodo['st_y']);
                        $p->setLng((float)$nodo['st_x']);
                        $p->setId($nodo['id']);

                        $t->addPunto($p); 
                        $em->merge($p);
                    }
                    $em->flush(); 
                }
                #$response = new Response(var_dump($t));     
                #return $response;
                $nodos = [];

                $em->persist($t);
                $em->flush();   

            }

/*
            $jsonContent = $serializer->serialize($ts, 'json', SerializationContext::create());*/

           
            
        } catch (Exception $ex) {

        }
    }
    
    public function getTramosAction()
    {
        try{
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository("AppBundle:Tramo");
            $serializer = $this->get('jms_serializer');
            
            $qb = $em->createQueryBuilder();
            $qb->select('t', 'p')   
                    ->from('AppBundle:Tramo', 't')
                    ->join('t.puntos', 'p');

            $query = $qb->getQuery();
            $itemsPage = $query->getArrayResult();

            $jsonContent = $serializer->serialize($itemsPage, 'json', SerializationContext::create());
            
            $response = new Response($jsonContent);     
            return $response;
            
        } catch (Exception $ex) {

        }
    }

    public function updateTramoAction(Request $request, $id)
    {
            $em = $this->getDoctrine()->getManager();
            $repoTramos   = $em->getRepository("AppBundle:Tramo");

            $serializer = SerializerBuilder::create()->build();
            $json_object = $this->get('request')->request->all();
            
            if(isset($json_object['id'])){
                $tramo = $repoTramos->find($json_object['id']);
            }

            if(isset($json_object['estado'])){
                $tramo->setEstado($json_object['estado']);
            }

            $em->persist($tramo);
            $em->flush();            
          
            $jsonContent = $serializer->serialize($rol, 'json');
            return new Response($jsonContent, 200);
            
    }

    public function getIncidentesAction(Request $request)
    {
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository("AppBundle:Incidente");
            $serializer = $this->get('jms_serializer');
            $json_object = $this->get('request')->request->all();

            $norte     = $json_object['norte'];
            $sur       = $json_object['sur'];
            $oeste     = $json_object['oeste'];
            $este      = $json_object['este'];

            $qb = $em->createQueryBuilder();
            $qb->select('i')
                    ->from('AppBundle:Incidente', 'i')
                    ->where($qb->expr()->gte('i.lng', $oeste))
                    ->andWhere($qb->expr()->lte('i.lng', $este))
                    ->andWhere($qb->expr()->gte('i.lat', $sur))
                    ->andWhere($qb->expr()->lte('i.lat', $norte));

            $query = $qb->getQuery();
            $itemsPage = $query->getArrayResult();
            
            $jsonContent = $serializer->serialize($itemsPage, 'json', SerializationContext::create()->setGroups(array('client')));
            
            $response = new Response($jsonContent);     
            return $response;
    }

    public function updateIncidenteAction(Request $request, $id)
    {
            $em = $this->getDoctrine()->getManager();
            $repoIncidente   = $em->getRepository("AppBundle:Incidente");

            $serializer = SerializerBuilder::create()->build();
            $json_object = $this->get('request')->request->all();
            
            if(isset($json_object['id'])){
                $incidente = $repoTramos->find($json_object['id']);
            }
            
            if(isset($json_object['estado'])){
                $incidente->setEstado($json_object['estado']);
            }

            $em->persist($incidente);
            $em->flush();            
          
            $jsonContent = $serializer->serialize($rol, 'json');
            return new Response($jsonContent, 200);
            
    }
}
