<?php
namespace App\View\Helper;

use Cake\View\Helper;

class OoiHelper extends Helper
{

  public $helpers = ['Html'];

  public function rdlink($reference_designator)
  {
    if (strlen($reference_designator)==8) {
      $link = $this->Html->link($reference_designator, ['controller'=>'sites', 'action' => 'view', $reference_designator]);
    } elseif (strlen($reference_designator)==14) {
      $link = $this->Html->link($reference_designator, ['controller'=>'nodes', 'action' => 'view', $reference_designator]);
    } else {
      $link = $this->Html->link($reference_designator, ['controller'=>'instruments', 'action' => 'view', $reference_designator]);
    }
    return $link;
  }

}