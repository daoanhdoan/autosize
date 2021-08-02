<?php
namespace Drupal\autosize\Form;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * @file
 * JQuery Autosize settings form include file.
 */
class AutosizeSettings extends ConfigFormBase
{
  /**
   * Admin settings menu callback.
   *
   * @see jquery_autosize_menu()
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $config = $this->config('autosize.settings');
    $form['variant'] = array (
      '#type' => 'radios',
      '#title' => t('Variant'),
      '#options' => array(
        'minified' => t('Production (minified)'),
        'uncompressed' => t('Development (uncompressed)'),
      ),
      '#default_value' => $config->get('variant'),
    );

    $form['trigger'] = array(
      '#type' => 'textarea',
      '#title' => t('Valid jQuery Classes/IDs to trigger autosize (One per line)'),
      '#default_value' => $config->get('trigger'),
      '#description' => t('Specify the class/ID of textareas to automatically adjust height, one per line. For example by providing "textarea" will convert any textareas'),
    );
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('autosize.settings');
    $config->set('variant', $form_state->getValue('variant'));
    $config->set('trigger', $form_state->getValue('trigger'));
    $config->save();
    $this->messenger()->addStatus($this->t('The Autosize settings have been saved.'));
  }

  /**
   * @inheritDoc
   */
  protected function getEditableConfigNames()
  {
    return ['autosize.settings'];
  }

  /**
   * @inheritDoc
   */
  public function getFormId()
  {
    return  "autosize_settings";
  }
}
