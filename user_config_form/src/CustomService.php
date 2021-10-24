<?php

namespace Drupal\user_config_form;

use Drupal\Component\Datetime\Time;

/**
 * Class CustomService
 * @package Drupal\user_config_form\Services
 */
class CustomService {

  protected $currentUser;

  /**
   * CustomService constructor.
   * @param AccountInterface $currentTime
   */
  public function __construct(Time $currentUser) {
    $this->currentUser = $currentUser;
  }


  /**
   * @return \Drupal\Component\Render\MarkupInterface|string
   */
  public function getData() {

    $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
    $timezone = $user->field_timezone->value;

    $datetime = new \Datetime;
    $otherTz = new \DatetimeZone($timezone);
    $datetime->setTimezone($otherTz);
    echo "<br>";
    return $datetime->format('d M Y - H:i');


    // $temp = $this->currentUser->getCurrentTime();
    // $date_output = date('d M Y - H:i', $temp);
    // return $date_output;
  }

}
