<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;

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
