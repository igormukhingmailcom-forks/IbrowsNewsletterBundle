<?php

namespace Ibrows\Bundle\NewsletterBundle\Service;

use Ibrows\Bundle\NewsletterBundle\Model\Job\MailJob;

class MailerService
{
	protected $mailer;
	protected $transport;
	protected $encryption;
	
	public function __construct($mailer, $transport, $encryption)
	{
		$this->mailer = $mailer;
		$this->transport = $transport;
		$this->encryption = $encryption;
	}
	
	public function send(MailJob $job)
	{
		$message = \Swift_Message::newInstance()
			->setSubject($job->getSubject())
			->setFrom($job->getSenderMail(), $job->getSenderName())
			->setReturnPath($job->getReturnMail())
			->setTo($job->getToMail())
			->setBody($job->getBody())
			->setContentType('text/html')
		;
		
		$this->transport->setUsername($job->getUsername());
		$password = $this->encryption->decrypt($job->getPassword(), $job->getSalt());
		$this->transport->setPassword($password);
		
		$this->transport->setHost($job->getHost());
		$this->transport->setPort($job->getPort());
		$this->transport->setEncryption($job->getEncryption());
		$this->transport->setAuthMode($job->getAuthMode());
		
		$this->mailer->newInstance($this->transport)->send($message);
	}
	
}
