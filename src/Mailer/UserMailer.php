<?php
namespace App\Mailer;

use Cake\Mailer\Mailer;

class UserMailer extends Mailer
{
    public function welcome($user)
    {
        $this
            ->to($user->email)
            ->subject(sprintf('[OOI Data Portal] Welcome %s', $user->first_name));
            //->template('welcome') // By default template with same name as method name is used.
            //->layout('custom');
    }

    public function resetPassword($user)
    {
        $this
            ->to($user->email)
            ->emailFormat('html')
            ->helpers(['Url'])
            ->subject('[OOI Data Portal] Password Reset')
            ->set(['token' => $user->token, 'first_name'=>$user->first_name]);
    }
}


