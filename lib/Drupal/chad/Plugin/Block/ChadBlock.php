<?php
/**
 * @file
 * Contains \Drupal\chad\Plugin\Block\ChadBlock.
 */

namespace Drupal\chad\Plugin\Block;

use Drupal\block\BlockBase;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a 'Chad' block.
 *
 * @Block(
 *   id = "chad_block",
 *   admin_label = @Translation("Chad block"),
 *   category = @Translation("Tacos")
 * )
 */
class ChadBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function access(AccountInterface $account) {
    // Only display the block if today's date is before the configured date.
    $config = $this->getConfiguration();
    if (!empty($config['chad_block_settings']) && strtotime($config['chad_block_settings']) >= REQUEST_TIME) {
      return FALSE;
    }
    return TRUE;
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    return array(
      '#type' => 'markup',
      '#markup' => 'Hello World',
    );
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, &$form_state) {
    $form = parent::blockForm($form, $form_state);

    $config = $this->getConfiguration();

    $form['chad_block_settings'] = array(
      '#type' => 'date',
      '#title' => t('Display until'),
      '#default_value' => isset($config['chad_block_settings']) ? $config['chad_block_settings'] : '',
      '#description' => t('The block will be displayed until the selected date.'),
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, &$form_state) {
    $this->setConfigurationValue('chad_block_settings', $form_state['values']['chad_block_settings']);
  }
}
