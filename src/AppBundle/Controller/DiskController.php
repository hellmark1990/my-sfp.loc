<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class DiskController
 * @package AppBundle\Controller
 *
 * @Route("/disk")
 */
class DiskController extends Controller
{
    /**
     * @Route("/")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $folders = $this->getDoctrine()->getRepository('AppBundle:Folder')->findBy(['parentId' => null]);

        if (!$folders) {
            throw $this->createNotFoundException('Unable to find Folder entities.');
        }

        return [
            'folders' => $folders,
        ];
    }
}
