<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Departement;
use AppBundle\Form\DepartementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/departement")
 */
class DepartementController extends Controller
{

    /**
     * @Route("/add", name="departement_add")
     */
    public function addAction(Request $request)
    {
        $dep = new Departement();
        $form = $this->createForm(DepartementType::class, $dep);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $name = $request->get('appbundle_departement')['name'];
            $domain = $request->get('appbundle_departement')['domaine'];

            if (empty($name)) {
                $err_name = '* Entrer un nom de departement !';
            }
            if ($domain == '0') {
                $err_domain = '* Selectionner un domaine !';
            }

            if ($domain != 0) {

                $conn = $this->getDoctrine()->getManager();
                $conn->persist($dep);
                $conn->flush();

                return $this->redirectToRoute('departement_show');

            }

        }

        return $this->render('@App/Departement/add.html.twig', [
            'form' => $form->createView(),
            'err_name' => @$err_name,
            'err_domain' => @$err_domain
        ]);
    }

    /**
     * @Route("/show", name="departement_show")
     */
    public function showAction()
    {

        $conn = $this->getDoctrine()->getManager();
        $departements = $conn->getRepository(Departement::class)->findAll();

        return $this->render('@App/Departement/show.html.twig', [
            'departements' => $departements
        ]);
    }

    /**
     * @Route("/update/{id}", name="departement_update")
     */
    public function updateAction(Request $request, $id)
    {
        $conn = $this->getDoctrine()->getManager();
        $dep = $conn->getRepository(Departement::class)->find($id);

        $form = $this->createForm(DepartementType::class, $dep);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $name = $request->get('appbundle_departement')['name'];
            $domain = $request->get('appbundle_departement')['domaine'];

            if (empty($name)) {
                $err_name = '* Entrer un nom de departement !';
            }
            if ($domain == '0') {
                $err_domain = '* Selectionner un domaine !';
            }

            if ($domain != 0) {

                $conn->persist($dep);
                $conn->flush();

                $this->addFlash(
                    'info',
                    'Département modifié avec succès !'
                );

                return $this->redirectToRoute('departement_show');
            }

        }

        return $this->render('@App/Departement/update.html.twig', [
            'form' => $form->createView(),
            'err_name' => @$err_name,
            'err_domain' => @$err_domain,
            'dynamic' => 'Modifier'
        ]);
    }

    /**
     * @Route("/delete/{id}", name="departement_delete")
     */
    public function deleteAction($id)
    {
        $conn = $this->getDoctrine()->getManager();
        $dep = $conn->getRepository(Departement::class)->find($id);

        $conn->remove($dep);
        $conn->flush();

        $this->addFlash(
            'info',
            'Département supprimé avec succès !'
        );

        return $this->redirectToRoute('departement_show');
    }

}
