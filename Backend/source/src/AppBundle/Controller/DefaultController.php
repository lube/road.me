<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\DoctrineBundle\ConnectionFactory;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;

use AppBundle\Entity\Punto;
use AppBundle\Entity\Tramo;
use AppBundle\Entity\Nodo;

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
                    ->join('AppBundle:Nodo', 'n', 'WITH', 'n.tramo = t.id')
                    ->join('AppBundle:Punto', 'p', 'WITH', 'n.punto = p.id')
                    ->where($qb->expr()->gte('p.lng', $oeste))
                    ->andWhere($qb->expr()->lte('p.lng', $este))
                    ->andWhere($qb->expr()->gte('p.lat', $sur))
                    ->andWhere($qb->expr()->lte('p.lat', $norte));
                  

            $query = $qb->getQuery();
            $itemsPage = $query->getArrayResult();

            $i = -1;

            foreach ($itemsPage as $key => $value) {
                if (isset($value['nombre'])) {
                    $i++;
                    $results[$i]['id'] = $value['id'];
                    $results[$i]['nombre'] = $value['nombre'];
                    $results[$i]['estado'] = $value['estado']; 
                    $j = 0;
                } else {
                    $results[$i]['puntos'][$j]['id'] = $value['id'];
                    $results[$i]['puntos'][$j]['lat'] = $value['lat'];
                    $results[$i]['puntos'][$j]['lng'] = $value['lng'];
                    $j++;
                }
            }
            
            $jsonContent = $serializer->serialize($itemsPage, 'json', SerializationContext::create());
            
            $response = new Response($jsonContent);     
            return $response;
            
        } catch (Exception $ex) {

        }
    }

    public function indexAction(Request $request)
    {
        return $this->render('AppBundle:Default:mapa.html.twig');
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
            ))->prepare('select id, tags, nodes from ways;');;

            $conn->execute();
            
            foreach ($conn->fetchAll() as $way) {
                if (isset($way['tags'])) {
                    $raw = explode(',', $way['tags']);
               
                    if (strpos($raw[0], 'name')) {
                        $pre = stripslashes(stripslashes($raw[0]));
                        $ways[] = array('id' => $way['id'], 'nodes' =>  explode(',',str_replace(array('{','}'), array('',''), $way['nodes']))) ;
                    }
                }

            }

            foreach ($ways as $way) {
                foreach ($way['nodes'] as $j => $pid) {
                    $conn = $connectionFactory->createConnection(array(
                        'driver' => 'pdo_pgsql',
                        'user' => 'osm',
                        'password' => '12341234',
                        'host' => 'localhost',
                        'dbname' => 'osm',
                    ));
                    $stmt = $conn->prepare('select id, ST_x(geom), ST_y(geom) from nodes where id ='. $pid .';');

                    $stmt->execute();
                    $result = $stmt->fetchAll();

                    $nodos[] = $result[0];

                    if ($conn->close()) {
                        $code = $conn->errorCode();
                        $desc = $conn->errorInfo();

                        $jsonContent = $serializer->serialize(array($code, $desc), 'json', SerializationContext::create());
                        $response = new Response($jsonContent);  
                    }
                }

                $t = new Tramo();
                $t->setEstado('TN');
                $t->setId($way['id']);
                $t->setNombre('t');

                $em->persist($t);
                $em->flush();
                set_time_limit (30);

                foreach ($nodos as $i => $nodo) {
                    $n = new Nodo();
                    
                    $p = $repoPuntos->find($nodo['id']);

                    if (!$p) {
                        $p = new Punto();
             
                        $p->setLat((float)$nodo['st_y']);
                        $p->setLng((float)$nodo['st_x']);
                        $p->setId($nodo['id']);

                        $em->persist($p);
                        $em->flush();
                    }

                    $n->setPunto($p);
                    $n->setTramo($t);
                    $n->setOrden($i);

                    $t->addNodo($n);

                    $em->persist($n);
                    $em->flush(); 
                }
                $nodos = [];

                $em->merge($t);
                $em->flush();   

            }

            $jsonContent = $serializer->serialize($t, 'json', SerializationContext::create());
            $response = new Response($jsonContent);     
            return $response;
            
        } catch (Exception $ex) {

        }
    }
    
    public function getTramosAction(Request $request)
    {
        try{
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository("AppBundle:Tramo");
            $serializer = $this->get('jms_serializer');
            
            $qb = $em->createQueryBuilder();
            $qb->select('t', 'p')   
                    ->from('AppBundle:Tramo', 't')
                    ->join('AppBundle:Nodo', 'n', 'WITH', 'n.tramo = t.id')
                    ->join('AppBundle:Punto', 'p', 'WITH', 'n.punto = p.id');
                  

            $query = $qb->getQuery();
            $itemsPage = $query->getArrayResult();

            $i = -1;
            
            foreach ($itemsPage as $key => $value) {
                if (isset($value['nombre'])) {
                    $i++;
                    $results[$i]['id'] = $value['id'];
                    $results[$i]['nombre'] = $value['nombre'];
                    $results[$i]['estado'] = $value['estado']; 
                    $j = 0;
                    if (!isset($itemsPage[$key+1]['lat'])) {
                        $results[$i]['puntos'][$j]['lat'] = 0;
                        $results[$i]['puntos'][$j]['lng'] = 0;
                    }
                } else {
            #       $results[$i]['puntos'][$j]['id'] = $value['id'];
                    $results[$i]['puntos'][$j]['lat'] = $value['lat'];
                    $results[$i]['puntos'][$j]['lng'] = $value['lng'];
                    $j++;
                }
            }


            $jsonContent = $serializer->serialize($results, 'json', SerializationContext::create());
        
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
