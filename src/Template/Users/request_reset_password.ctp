<div class="row">
  <div class='col-md-6 col-md-offset-3'>

    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Forgot your Password?') ?></legend>
        <p>Enter your email address here and we will send you instructions on how to reset your password.</p>
        <?php
            echo $this->Form->input('email');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>

  </div>
</div>
