<?php

namespace MCM\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use MCM\ClientBundle\Entity\Client;
use MCM\ClientBundle\Form\ClientType;
use Symfony\Component\HttpFoundation\Request;


class ClientController extends Controller
{
    /* Pinta el formulario */
    public function formAction(Request $request) {
        /*Si recibe un id deberá rellenar el formulario con toda la información de ese cliente*/
        if($request->query->get('id')) {
            $id = $request->query->get('id');
            $form = $this->createFormEdit($id);
        } else { /*Si no recibe id pintará el formulario vacío*/
            $client = new Client();
            $form = $this->createForm(new ClientType(), $client);
        }

        return $this->render('MCMClientBundle:Client:form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /* Ejecuta la query correspondiente (insert o update) */
    public function queryAction (Request $request) {
        $modal = false;
        $id = '';

        $clientEmpty = new Client();
        $clientId = $request->request->get('mcm_clientbundle_client')['id'];
        $form = $this->createForm(new ClientType(), $clientEmpty);
        /*Si recibe un Id tiene que actualizar al cliente*/
        if(!empty($clientId)) {
            $em = $this->getDoctrine()->getManager();
            $client = $em->getRepository(Client::class)->find($clientId);

            $this->update($request, $client);
        } else { /* Será el insert de un cliente*/
            $client = $form->getData();
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $responseExists = $this->exists($client);
                $exists = $responseExists['exists'];

                if(!$exists) {
                    $this->create($request, $client);
                } else {
                    $modal = true;
                    $id = $responseExists['id'];
                }          
            }
        }

        return $this->render('MCMClientBundle:Client:form.html.twig', array(
            'form' => $form->createView(), 'modal' => $modal, 'id' => $id
        ));
    }

    /* Crea un formulario con los datos de un cliente */
    private function createFormEdit($idClient) {

        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository(Client::class)->findOneBy(array('id' => $idClient));

        $form = $this->createForm(new ClientType($this->getDoctrine()->getManager()), $client, array(
            'action' => $this->generateUrl('mcm_client_query'),
            'save_button_label' => 'Update client'
        ));

        return $form;
    }

    /*Inserta un nuevo cliente*/
    private function create(Request $request, $client) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($client);
        $em->flush();

        $request->getSession()
            ->getFlashBag()
            ->add('success', 'Client insert!');
    }

    /* Actualiza los valores de un cliente */
    private function update(Request $request, $client) {
        $client->setFullName($request->request->get('mcm_clientbundle_client')['fullName']);
        $client->setEmail($request->request->get('mcm_clientbundle_client')['email']);
        $client->setIdCard($request->request->get('mcm_clientbundle_client')['idCard']);
        if(isset($request->request->get('mcm_clientbundle_client')['subscribed'])) {
            $client->setSubscribed(true);
        } else {
            $client->setSubscribed(false);
        }
        $client->setTypeCachtment($request->request->get('mcm_clientbundle_client')['typeCachtment']);
        $client->setAddress($request->request->get('mcm_clientbundle_client')['address']);
        if(empty($request->request->get('mcm_clientbundle_client')['zipCode'])){
            $zipCode = NULL;
        } else {
            $zipCode = $request->request->get('mcm_clientbundle_client')['zipCode'];
        }
        $client->setZipCode($zipCode);
        $client->setState($request->request->get('mcm_clientbundle_client')['state']);
        $client->setCity($request->request->get('mcm_clientbundle_client')['city']);
        $client->setCountry($request->request->get('mcm_clientbundle_client')['country']);
        $client->setComments($request->request->get('mcm_clientbundle_client')['comments']);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        $request->getSession()
            ->getFlashBag()
            ->add('success', 'Client updated!');
    }

    /* Comprueba si existe un cliente con ese email o documento de identidad*/
    private function exists($client) {
        $exists = false;
        $id = '';

        $email = $client->getEmail();
        $idCard = $client->getIdCard();

        $em = $this->getDoctrine()->getManager();
        $client1 = $em->getRepository(Client::class)->findOneBy(array('email' => $email));
        $client2 = $em->getRepository(Client::class)->findOneBy(array('idCard' => $idCard));

        if ($client1 || $client2) {
            $exists = true;
            if ($client1) {
                $id = $client1->getId();
            } else {
                $id = $client2->getId();
            }
        }

        $response = array('exists' => $exists, 'id' => $id);

        return $response;
    }
}
