<?php
/**
 * @file
 */

namespace Drupal\chad\Form;

use Drupal\Core\Form\ConfigFormBase;

class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'chad_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, array &$form_state) {
    $config = $this->configFactory->get('chad.settings');

    $form['testing'] = array(
      '#type' => 'textfield',
      '#title' => 'Testing',
      '#default_value' => $config->get('testing'),
    );

    $name = $config->get('name');
    debug($name);

    $form['first'] = array(
      '#type' => 'textfield',
      '#title' => 'First name',
      '#default_value' => $name['first'],
    );
    $form['last'] = array(
      '#type' => 'textfield',
      '#title' => 'Last name',
      '#default_value' => $name['last'],
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, array &$form_state) {
    debug($form_state['values']);

    // chad.settings.yml
    $config = $this->configFactory->get('chad.settings');
    $config->set('testing', $form_state['values']['testing']);
    $config->set('name.first', $form_state['values']['first']);
    $config->set('name.last', $form_state['values']['last']);
    $config->save();

    return parent::submitForm($form, $form_state);
  }

}
