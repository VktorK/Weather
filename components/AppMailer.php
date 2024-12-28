<?php
namespace app\components;

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

class AppMailer
{
    private $mailer;

    public function __construct()
    {
// Настройка транспортного протокола
        $transport = Transport::fromDsn('smtp://viktorkorochanskiy@rambler.ru:Sherlock011@smtp.rambler.ru:587');
        $this->mailer = new Mailer($transport);
    }

    public function sendEmail($to, $subject, $body)
    {
        $email = (new Email())
            ->from('viktorkorochanskiy@rambler.ru')
            ->to($to)
            ->subject($subject)
            ->text($body);

        $this->mailer->send($email);
    }
}