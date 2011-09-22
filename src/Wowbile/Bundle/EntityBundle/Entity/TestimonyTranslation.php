<?php

namespace Wowbile\Bundle\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Wowbile\Bundle\FrontendBundle\Entity\WowkipediaEntryTranslation
 *
 * @ORM\Table(name="testimony_translation")
 * @ORM\Entity()
 */
class TestimonyTranslation
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
    * @ORM\Column(type="string", length="5")
    */
    protected $locale;
        
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;
    
    /**
    * @ORM\ManyToOne(targetEntity="Testimony", inversedBy="translations")
    * @ORM\JoinColumn(name="testimony_id", referencedColumnName="id")
    */
    protected $testimony;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function setTestimony($testimony)
    {
    	$this->testimony = $testimony;
    }
    
    public function getLocale()
    {
    	return $this->locale;
    }
    
    public function setLocale($locale)
    {
    	$this->locale = $locale;
    }
   
    
    public function getDescription()
    {
   		return $this->description;
    }
    
    public function setDescription($desc)
    {
    	$this->description = $desc;
    }
}