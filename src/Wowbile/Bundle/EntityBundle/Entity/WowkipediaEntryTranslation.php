<?php

namespace Wowbile\Bundle\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Wowbile\Bundle\FrontendBundle\Entity\WowkipediaEntryTranslation
 *
 * @ORM\Table(name="wowkipedia_translation")
 * @ORM\Entity()
 */
class WowkipediaEntryTranslation
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
    * @ORM\Column(type="string", length="255")
    */
    protected $name;
        
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;
    
    /**
    * @ORM\ManyToOne(targetEntity="WowkipediaEntry", inversedBy="translations")
    * @ORM\JoinColumn(name="entry_id", referencedColumnName="id")
    */
    protected $entry;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function setEntry($entry)
    {
    	$this->entry = $entry;
    }
    
    public function getEntry()
    {
    	return $this->entry;
    }
    
    public function getLocale()
    {
    	return $this->locale;
    }
    
    public function setLocale($locale)
    {
    	$this->locale = $locale;
    }
    
    public function getName()
    {
    	return $this->name;
    }
    
    public function setName($name)
    {
    	$this->name = $name;
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