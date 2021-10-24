<?php

namespace Drupal\user_config_form\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a block with a simple text.
 *
 * @Block(
 *   id = "my_block",
 *   admin_label = @Translation("My block"),
 * )
 */
class Block extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#theme' => 'my_block',
      '#data' => [],
    ];
  }
}
