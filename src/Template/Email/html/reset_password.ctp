<p>Hi <?= $first_name ?>,</p>

<p>We received a request to reset your password on the OOI Data Portal.</p>

<p>You can use the following link within the next day to update your password.<br>
<?php echo $this->Url->build(array('prefix'=>false, 'controller'=>'Users', 'action' => 'resetPassword', $token), true)?></p>

<p>If you did not make this request, or do not wish to change your password, simply ignore this email.  This link will expire after 24 hours.</p>

<p>To request a new password reset link, please visit the following link.<br>
<?php echo $this->Url->build(array('prefix'=>false, 'controller'=>'Users', 'action' => 'requestResetPassword'), true)?></p>

<p>OOI Data Portal Support</p>
