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
        $clientEmpty = new Client();
        $form = $this->createForm(new ClientType(), $clientEmpty);
        $form->handleRequest($request);

        $client = $form->getData();

        /* Si en el formulario no está vacío el campo Id corresponderá un update */
        if(isset($request->request->get('mcm_clientbundle_client')['id']) && !empty($request->request->get('mcm_clientbundle_client')['id'])) {
            $this->update($client);
        } else { /* Será el insert de un cliente*/
            if ($form->isSubmitted() && $form->isValid()) {
                $exists = $this->exists($client);

                if(!$exists) {
                    $this->create($client);
                } else {
                    $modal = true;
                }          
            }
        }

        return $this->render('MCMClientBundle:Client:form.html.twig', array(
            'form' => $form->createView(), 'modal'=> $modal
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
    private function create($client) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($client);
        $em->flush();

        $request->getSession()
            ->getFlashBag()
            ->add('success', 'Client insert!');
    }

    /* Actualiza los valores de un cliente */
    private function update($form) {
        $clientId = $request->request->get('id');;
        $client = $em->getRepository(Client::class)->find($clientId);

        $em = $this->getDoctrine()->getManager();
        $em->persist($client);
        $em->flush();

        $request->getSession()
            ->getFlashBag()
            ->add('success', 'Client updated!');
    }

    /* Comprueba si existe un cliente con ese email o documento de identidad*/
    private function exists($client) {
        $exists = false;

        $email = $client->getEmail();
        $idCard = $client->getIdCard();

        $em = $this->getDoctrine()->getManager();
        $client1 = $em->getRepository(Client::class)->findOneBy(array('email' => $email));
        $client2 = $em->getRepository(Client::class)->findOneBy(array('idCard' => $idCard));

        if ($client1 || $client2) {
            $exists = true;
        }

        return $exists;
    }
}
