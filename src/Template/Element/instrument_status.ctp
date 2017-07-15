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
    'Adrift' => [
      'icon'=>'glyphicon-ban-circle', 
      'title'=>'Adrift', 
      'color'=>'red'],
    'Lost' => [
      'icon'=>'glyphicon-ban-circle', 
      'title'=>'Lost', 
      'color'=>'grey'],
    'Not Deployed' => [
      'icon'=>'glyphicon-remove-circle', 
      'title'=>'Not Deployed', 
      'color'=>'grey'],
    'Camera' => [
      'icon'=>'glyphicon-ok-circle', 
      'title'=>'Camera', 
      'color'=>'grey'],
    'Recovered Only' => [
      'icon'=>'glyphicon-ok-circle', 
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
