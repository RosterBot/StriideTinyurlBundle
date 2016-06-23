<?php

namespace Striide\TinyurlBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 *
 */
class UrlController extends Controller
{
  public function shortAction($short)
  {
    if(strlen($short) > 255)
    {
      $short = substr($short, 0, 255);
    }
    $url = $this->get('striide_tinyurl.service')->getUrl($short);

    if (empty($url))
    {
      throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
    }

    $this->get('striide_tinyurl.service')->trackClick($short);
    return $this->redirect(urldecode($url->getUri()));
  }

}
