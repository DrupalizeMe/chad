<?php

namespace Drupal\chad\Controller;

use Drupal\Core\Controller\ControllerInterface;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ChadController implements ContainerInjectionInterface {

  public static function create(ContainerInterface $container) {
    return new static($container->get('module_handler'));
  }

  public function chadPage() {
    $build = array(
      '#type' => 'markup',
      '#markup' => t('Hello World!'),
    );
    return $build;
  }
}
