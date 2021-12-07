<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Computer;
use AppBundle\Entity\Departement;
use AppBundle\Form\ComputerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\route;

/**
 * @Route("/computer")
 */
class ComputerController extends Controller
{
    /**
     * @Route("/add/{id}", name="computer_add")
     */
    public function addAction(Request $request, $id)
    {

        $conn = $this->getDoctrine()->getManager();
        $dep = $conn->getRepository(Departement::class)->find($id);
        $domain = $dep->getDomaine();

        $computer = new Computer();
        $form = $this->createForm(ComputerType::class, $computer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // UPLOADS FILES
            $files = $request->files->get('appbundle_computer')['images'];

            $images = [];

            if ($files) {
                foreach ($files as $file) {

                    $fileName = sprintf(
                        '%s_%s.%s', $file->getClientOriginalName(), uniqid(), $file->guessExtension()
                    );

                    $images[] = $fileName;  // ou array_push($images, $fileName);                 

                    $file->move($this->getParameter('UploadsDir'), $fileName);
    
                }
            }

            $computer->setImages($images);
            $computer->setNameDepartement($dep);
            $conn->persist($computer);
            $conn->flush();

            return $this->redirectToRoute('computer_show');

        }

        return $this->render('@App/Computer/add.html.twig', [
            'form' => $form->createView(),
            'domain' => $domain,
            'id' => $id
        ]);
    }

    /**
     * @Route("/show", name="computer_show")
     */
    public function showAction()
    {
        $conn = $this->getDoctrine()->getManager();
        $computers = $conn->getRepository(Computer::class)->findAll();

        return $this->render('@App/Computer/show.html.twig', [
            'computers' => $computers
        ]);
    }

    /**
     * @Route("/show/images/{id}", name="computer_show_img")
     */
    public function showImagesAction($id)
    {
        $conn = $this->getDoctrine()->getManager();
        $computers = $conn->getRepository(Computer::class)->find($id);

        return $this->render('@App/Computer/show_img.html.twig', [
            'computers' => $computers
        ]);
    }

    /**
     * @Route("/update")
     */
    public function updateAction()
    {
        return $this->render('@App/Computer/update.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/delete")
     */
    public function deleteAction()
    {
        return $this->render('@App/Computer/delete.html.twig', array(
            // ...
        ));
    }

}
