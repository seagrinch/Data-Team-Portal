<?php 
use Cake\Core\Configure;

$this->prepend('meta', $this->Html->meta('favicon.ico', '/favicon.ico', ['type' => 'icon']));
$this->prepend('css', $this->Html->css(['bootstrap/bootstrap', 'custom'])); 
$this->prepend('script', $this->Html->script(['jquery/jquery', 'bootstrap/bootstrap']));

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster|Roboto">
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?= $this->fetch('title') ?></title>

  <?= $this->fetch('meta') ?>
  <?= $this->fetch('css') ?>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body>
  <!-- Fixed navbar -->
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="/" style="padding-top:0px;"><?php echo $this->Html->image('logo.png')?></a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/"><?= Configure::read('App.title') ?></a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><?php echo $this->Html->link('Arrays', '/regions')?></li>
          <li><?php echo $this->Html->link('Instruments', '/instruments/all')?></li>
          <li><?php echo $this->Html->link('Classes', '/instrumentClasses')?></li>
          <li><?php echo $this->Html->link('Nuggets', '/nuggets')?></li>
          <li class="dropdown"><?php echo $this->Html->link('Reference <span class="caret"></span>','#',array('escape'=>false,'class'=>'dropdown-toggle','data-toggle'=>'dropdown','role'=>'button','aria-expanded'=>'false'))?>           
            <ul class="dropdown-menu" role="menu">
              <li><?php echo $this->Html->link('Reference Index', '/pages/reference')?></li>
              <li><?php echo $this->Html->link('Parameters','/parameters/all')?></li>
              <li><?php echo $this->Html->link('Streams','/streams/all')?></li>
              <li role="separator" class="divider"></li>
              <li><?php echo $this->Html->link('Notes','/notes')?></li>
              <li><?php echo $this->Html->link('Instrument Progress','/instruments/status')?></li>
              <li><?php echo $this->Html->link('Review Progress','/reviews/status')?></li>
              <li role="separator" class="divider"></li>
              <li><?php echo $this->Html->link('Import Log','/import-log')?></li>
              <li><?php echo $this->Html->link('Array Stats','/regions/array-monthly')?></li>
            </ul>
          </li>
          <?php 
            $session = $this->request->session();
            if ($session->check('Auth.User')) { ?>
          <li class="dropdown"><?php echo $this->Html->link('<span class="glyphicon glyphicon-user" aria-hidden="true"></span> ' . $session->read('Auth.User.first_name') . ' <span class="caret"></span>','/users/profile',array('escape'=>false,'class'=>'dropdown-toggle','data-toggle'=>'dropdown','role'=>'button','aria-expanded'=>'false'))?>
            <ul class="dropdown-menu" role="menu">
              <li><?php echo $this->Html->link('My Profile','/users/profile')?></li>
              <li><?php echo $this->Html->link('Team List','/users/')?></li>
              <?php if ($session->read('Auth.User.role')=='admin') { ?>
              <li><?php echo $this->Html->link('User Admin','/admin/users')?></li>
              <?php } ?>
              <li class="divider"></li>
              <li><?php echo $this->Html->link('Sign Out','/users/logout')?></li>
            </ul>
          </li>
          <?php } else { ?>
          <li><?php echo $this->Html->link('Sign In','/users/login',array('class'=>''))?></li>
          <?php } ?>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>

  <div class="container">
    <?php 
      if (isset($this->Flash)) {
        echo $this->Flash->render(); 
        echo $this->Flash->render('auth'); 
      } ?>

    <?= $this->fetch('content') ?>

    <hr>

    <footer>
      <div class="row">
        <div class="col-md-6">
          <?php printf('&copy;%s %s', date('Y'), Configure::read('App.title')); ?>, Rutgers University
          <p><small>This site was developed with the support of the National Science Foundation under Grant No. OCE-1841799. Any opinions, findings, and conclusions or recommendations expressed in this material are those of the authors and do not necessarily reflect the views of the National Science Foundation.</small></p>
        </div>
        <div class="col-md-6 text-right">
          <?= $this->Html->link('About Us','/pages/about') ?> |
          <?= $this->Html->link('Contact Us','/pages/contact') ?> |
          <a href="https://rucool.marine.rutgers.edu">RU COOL</a>
        </div>
      </div>
    </footer>

  </div> <!-- /container -->

  <?php echo $this->fetch('script'); ?>

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-48897328-5"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
  
    gtag('config', 'UA-48897328-5');
  </script>

</body>
</html>






