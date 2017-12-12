<?php 
  $icons = [
    'Operational' => [
      'icon'=>'glyphicon-ok-circle', 
      'title'=>'Operational', 
      'color'=>'green'],
    'Not Operational' => [
      'icon'=>'glyphicon-remove-circle', 
      'title'=>'Not Operational', 
      'color'=>'red'],
    'Engineering' => [
      'icon'=>'glyphicon-exclamation-sign', 
      'title'=>'Engineering', 
      'color'=>'grey'],
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
    'Camera' => [
      'icon'=>'glyphicon-camera', 
      'title'=>'Camera', 
      'color'=>'grey'],
    'Recovered Only' => [
      'icon'=>'glyphicon-minus-sign', 
      'title'=>'Recovered Only', 
      'color'=>'grey'],
    '' => [
      'icon'=>'glyphicon-question-sign', 
      'title'=>'Unknown', 
      'color'=>'grey'],
  ];
  if (array_key_exists($status,$icons)) {
    $icon = $icons[$status];
  } else {
    $icon = $icons[''];
  }
?>
<span class="glyphicon <?= $icon['icon']?>" style="font-size: 1.0em; color:<?= $icon['color']?>;" aria-hidden="true" title="<?=$icon['title']?>"></span> <?php if(!isset($notitle)) { echo $icon['title']; } ?>
