<?php

namespace Drupal\tiles_grid\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\tiles_grid\Controller\tilesDataController;

class tilesController extends ControllerBase {
  /**
   * Constructs a tilesDataController object.
   *
   */

  public function grid() {
    $tiles_grid = new tilesDataController();

    return [
      $tiles_grid->grid_data(),
    ];
  }

  public function getCacheMaxAge() {
    return 0;
  }
}