<?php

namespace Drupal\tiles_grid\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Entity\Query\QueryFactory;

class tilesDataController extends ControllerBase {
  /**
   * Constructs a tilesDataController object.
   *
   */

  public function grid_data() {
    $entity_queue_id = 'tiles';
    // Collect list of entity subqueue
    $entity_subqueue = \Drupal\entityqueue\Entity\EntitySubqueue::load($entity_queue_id);

    $nids = [];
    foreach ($entity_subqueue->get('items')->getValue() as $nid) {
      $nids[] = ($nid['target_id']);
    }

    // List of taxonomy to set heading of tiles
    $entity_tags = 'tags';
    $tree = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree( $entity_tags, 0, 1, TRUE);
    $tile_heads_id_twig = [];
    foreach ($tree as $term) {
      $tile_heads_id_twig[] = $term->tid->value;
    }

    $entity_data = [];
    $node_storage = \Drupal::entityTypeManager()->getStorage('node');
    $nodes = $nids ? $node_storage->loadMultiple($nids) : [];
    foreach ($nodes as $node) {
      $tile_type = $node->field_tile_types->value;
      // Set node storage as ARTICLE for tile type as article and source element as article
      if (isset($node->field_element_source->value) && $node->field_element_source->value == 'articles'  && $tile_type == 'reference') {
        if (!empty($node->field_articles->entity)) {
          $ref_article = $node->field_articles->entity;
          $ref_article_id = $ref_article->nid->value;
          $node = $ref_article_id ? \Drupal\node\Entity\Node::load($ref_article_id) : [];
        }
      }

      $nid = $node->nid->value;
      $tid = $node->get('field_tags')->target_id;

      // Image rendering details for tiles
      if (isset($node->field_image->entity)) {
        $original_image = $node->field_image->entity->getFileUri();
        $style = \Drupal::entityTypeManager()->getStorage('image_style')->load('tiles');
        $img_url = $style->buildUrl($original_image);
      } else {
        $img_url = file_url_transform_relative(file_create_url(theme_get_setting('logo.url')));
      }

      // Term rendering details for tiles
      $terms = $node->field_tags->referencedEntities();
      $icon_data = [];
      $term_id = '';
      foreach ($terms as $term) {
        $term_id .= $term->tid->value.' ';
        $term_icon = $term->field_icons->icon_name;
        if (!empty($term->field_icons->style)) {
          $term_style = $term->field_icons->style;
        } else {
          $term_style = 'fas ';
        }
        $icon_data[] = $term_style .' fa-'. $term_icon;
      }

      // Hyperlink rendering details for tiles
      if ($tile_type == 'reference') {
        $url = \Drupal::service('path.alias_manager')->getAliasByPath('/node/'.$node->nid->value);
        $url_target = "_self";
      } else {
        if (!empty($node->field_url->uri)) {
          $url = $node->field_url->uri;
          $url_target = "_blank";
        } else {
          $url = '';
        }
      }

      // Youtube rendering details for tiles
      if (!empty($node->field_embed_video->value)) {
        preg_match('/^https?:\/\/(www\.)?((?!.*list=)youtube\.com\/watch\?.*v=|youtu\.be\/)(?<id>[0-9A-Za-z_-]*)/', $node->field_embed_video->value, $matches);
        $video_url = $node->field_embed_video->value;
        $video_id = $matches['id'];
      } else {
        $video_url = '';
        $video_id = '';
      }

      // Differenet set of information is passed to template for displaying tiles
      $entity_data[] = [
        'nid' => $nid,
        'tid' => $term_id,
        'img' => $img_url,
        'title' => $node->getTitle(),
        'text' => $node->body->value,
        'icon_data' => $icon_data,
        'type' => $tile_type,
        'url' => $url,
        'video_url' => $video_url,
        'video_id' => $video_id,
      ];
    }

    return [
      '#theme' => 'tiles_grid',
      '#entity_data' => $entity_data,
      '#tile_heads_id_twig' => $tile_heads_id_twig,
    ];
  }

  public function getCacheMaxAge() {
    return 0;
  }
}