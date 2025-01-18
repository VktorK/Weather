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
        $transport = Transport::fromDsn('smtp://vktork@rambler.ru:Sherlock011@smtp.rambler.ru:587');
        $this->mailer = new Mailer($transport);
    }

    public function sendEmail($to, $subject, $body,$attach)
    {
        try {
            $result = (new Email())
                ->from('vktork@rambler.ru')
                ->to($to)
                ->subject($subject)
                ->html($body)
                ->attachFromPath($attach, $attach, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

            $this->mailer->send($result);
            echo 'Письмо успушно отправлено';
        } catch (\Exception $e) {
            echo 'Ощибка отправки письма' . $e->getMessage();
        }
    }
}