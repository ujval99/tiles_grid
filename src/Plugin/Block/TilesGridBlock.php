<?php

namespace Drupal\tiles_grid\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\tiles_grid\Controller\tilesDataController;

/**
 * Provides a 'tiles grid' Block.
 *
 * @Block(
 *   id = "tiles_grid",
 *   admin_label = @Translation("tiles grid block"),
 *   category = @Translation("tiles_component"),
 * )
 */
class TilesGridBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $tiles_grid = new tilesDataController();

    return [
      $tiles_grid->grid_data(),
    ];
  }

  /**
   * Setting up cache mechanism
   */
  public function getCacheMaxAge() {
    return 0;
  }
}