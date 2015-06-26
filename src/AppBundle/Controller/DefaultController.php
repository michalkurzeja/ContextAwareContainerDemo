<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/{context}", name="test")
     * @param $context
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($context)
    {
        $processor = $this->getContextSensitive($context, 'processor');

        return $this->render('default/index.html.twig', [
            'context' => $context,
            'result' => $processor->process()
        ]);
    }

    /**
     * @Route("/{context}/universal", name="test-universal")
     * @param $context
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function universalAction($context)
    {
        $processor = $this->getContextSensitive($context, 'processor.universal');

        return $this->render('default/index.html.twig', [
            'context' => $context,
            'result' => $processor->process()
        ]);
    }

    /**
     * @Route("/{context}/dependant", name="test-dependant")
     * @param $context
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dependantAction($context)
    {
        $processor = $this->getContextSensitive($context, 'processor.dependant');

        return $this->render('default/index.html.twig', [
            'context' => $context,
            'result' => $processor->process()
        ]);
    }

    public function getContextSensitive($context, $alias)
    {
        return $this->get('app.container.context_aware')->get($context, $alias);
    }
}
