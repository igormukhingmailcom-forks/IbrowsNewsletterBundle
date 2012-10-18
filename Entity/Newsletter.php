<?php

namespace Ibrows\Bundle\NewsletterBundle\Entity;

use Ibrows\Bundle\NewsletterBundle\Model\Newsletter\Newsletter as AbstractNewsletter;

use Doctrine\ORM\Mapping as ORM;

class Newsletter extends AbstractNewsletter
{
	/**
	 * @ORM\Column(type="string", name="subject")
	 */
	protected $subject;
    
	/**
	 * @ORM\Column(type="string", name="sender_mail")
	 */
	protected $senderMail;
    
	/**
	 * @ORM\Column(type="string", name="sender_name")
	 */
	protected $senderName;
    
	/**
	 * @ORM\Column(type="string", name="return_mail")
	 */
	protected $returnMail;
}
