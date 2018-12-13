<?php 
  $icons = [
    '' => [
      'icon'=>'glyphicon-question-sign', 
      'title'=>'Unknown', 
      'color'=>'grey'],
    'Engineering' => [
      'icon'=>'glyphicon-cog', 
      'title'=>'Engineering', 
      'color'=>'grey'],
    'Camera' => [
      'icon'=>'glyphicon-camera', 
      'title'=>'Camera', 
      'color'=>'grey'],
    'Todo' => [
      'icon'=>'glyphicon-star', 
      'title'=>'Todo', 
      'color'=>'orange'],
    'Will Not Review' => [
      'icon'=>'glyphicon-minus-sign', 
      'title'=>'Will Not Review', 
      'color'=>'grey'],
    'Blocked' => [
      'icon'=>'glyphicon-alert', 
      'title'=>'Review Blocked', 
      'color'=>'red'],
    'In Progress' => [
      'icon'=>'glyphicon-adjust', 
      'title'=>'Review in Progress', 
      'color'=>'blue'],
    'Complete' => [
      'icon'=>'glyphicon-ok-sign', 
      'title'=>'Review Complete', 
      'color'=>'green'],
    'Operational' => [
      'icon'=>'glyphicon-ok-circle', 
      'title'=>'Operational', 
      'color'=>'green'],
    'Not Operational' => [
      'icon'=>'glyphicon-remove-circle', 
      'title'=>'Not Operational', 
      'color'=>'red'],
    'Adrift' => [
      'icon'=>'glyphicon-ban-circle', 
      'title'=>'Adrift', 
      'color'=>'red'],
    'Lost' => [
      'icon'=>'glyphicon-ban-circle', 
      'title'=>'Lost', 
      'color'=>'grey'],
    'Suspended' => [
      'icon'=>'glyphicon-remove-circle', 
      'title'=>'Suspended', 
      'color'=>'grey'],
    'Recovered Only' => [
      'icon'=>'glyphicon-minus-sign', 
      'title'=>'Recovered Only', 
      'color'=>'grey'],
  ];
  if (array_key_exists($status,$icons)) {
    $icon = $icons[$status];
  } else {
    $icon = $icons[''];
  }
?>
<span class="glyphicon <?= $icon['icon']?>" style="font-size: 1.0em; color:<?= $icon['color']?>;" aria-hidden="true" title="<?=$icon['title']?>"></span> <?php if(!isset($notitle)) { echo $icon['title']; } ?>
