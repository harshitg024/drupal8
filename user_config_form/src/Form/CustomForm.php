<?php

/**
 * @file
 * Contains \Drupal\user_config_form\Form\CustomForm.
 */

namespace Drupal\user_config_form\Form;

use Drupal\Component\Datetime\TimeInterface;
use Drupal\Core\Datetime\DateFormatterInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CustomForm extends FormBase {

  /**
   * The date formatter service.
   *
   * @var \Drupal\Core\Datetime\DateFormatterInterface
   */
  protected $dateFormatter;

  /**
   * The time service.
   *
   * @var \Drupal\Component\Datetime\TimeInterface
   */
  protected $time;

  /**
   * CustomForm constructor.
   *
   * @param \Drupal\Core\Datetime\DateFormatterInterface $date_formatter
   *   The date formatter service.
   * @param \Drupal\Component\Datetime\TimeInterface $time
   *   The time service.
   */
  public function __construct(DateFormatterInterface $date_formatter, TimeInterface $time) {
    $this->dateFormatter = $date_formatter;
    $this->time = $time;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('date.formatter'),
      $container->get('datetime.time'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'admin_config_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['country'] = array(
      '#type' => 'textfield',
      '#title' => t('Country :'),
      '#required' => TRUE,
    );

    $form['city'] = array(
      '#type' => 'textfield',
      '#title' => t('City :'),
      '#required' => TRUE,
    );

    $form['timezone'] = array (
    '#type' => 'select',
    '#title' => ('Timezone'),
    '#options' => array(
      'America/Chicago' => t('America/Chicago'),
      'America/New_York' => t('America/New_York'),
      'Asia/Tokyo' => t('Asia/Tokyo'),
      'Asia/Dubai' => t('Asia/Dubai'),
      'Asia/Kolkata' => t('Asia/Kolkata'),
      'Europe/Amsterdam' => t('Europe/Amsterdam'),
      'Europe/Oslo' => t('Europe/Oslo'),
      'Europe/London' => t('Europe/London'),
    ),
    );

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
    // $r_period = $user->field_timezone->value;
    // drupal_set_message($user->field_timezone->value);
    $temp = $form_state->getValue(['timezone']);
    $user->field_timezone->value = $temp;
    $user->save();
    drupal_set_message($user->field_timezone->value);
  }
}
