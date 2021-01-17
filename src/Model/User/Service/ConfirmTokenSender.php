<?php


namespace App\Model\User\Service;


use App\Model\User\Entity\User\Email;
use Twig\Environment;

class ConfirmTokenSender
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * @var Environment
     */
    private $twig;
    /**
     * @var array
     */
    private $from;

    public function __construct(\Swift_Mailer $mailer, Environment $twig, array $from)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->from = $from;
    }

    public function send(Email $email, string $token): void
    {
        $message = (new \Swift_Message('Registration confirmation'))
            ->setFrom('app@app.test')
            ->setTo($email->getValue())
            ->setBody(
                $token
            );
        if(!$this->mailer->send($message)) {
            throw new \Exception('Unable to send message.');
        }
    }
}