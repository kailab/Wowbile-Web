<?php

namespace Wowbile\Bundle\EntityBundle\Entity;

use Kailab\Bundle\SharedBundle\Entity\TranslatedEntity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Wowbile\Bundle\FrontendBundle\Entity\WowkipediaEntry
 *
 * @ORM\Table(name="links")
 * @ORM\Entity(repositoryClass="Wowbile\Bundle\EntityBundle\Repository\LinkRepository")
 */
class Link extends TranslatedEntity
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
    * @ORM\OneToMany(targetEntity="LinkTranslation", mappedBy="link", cascade={"persist", "remove"})
    */
    protected $translations;
    
    /**
    * @ORM\Column(type="datetime")
    */
    protected $created;
    
    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated;
    
    /**
    * @ORM\Column(type="boolean")
    */
    protected $active = true;
    
    /**
    * @ORM\Column(type="boolean")
    */
    protected $homepage = false;
    
    /**
    * @ORM\Column(type="string", length="255", nullable=false)
    */
    protected $url;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function __toString()
    {
    	try{
	    	return '<a target="_blank" href="'.$this->getUrl().'">'
	    		.$this->getName().'</a>';
    	}catch(\Exception $e){
    		return $e->getMessage();
    	}
    }
    
    public function getUrl()
    {
    	return $this->url;
    }
    
    public function setUrl($url)
    {
    	$this->url = $url;
    }
    
    public function getCreated()
    {
    	return $this->created;
    }
    
    public function setCreated($d)
    {
    	$this->created = $d;
    }
    
    public function getUpdated()
    {
    	return $this->updated;
    }
    
    public function setUpdated($d)
    {
    	$this->updated = $d;
    }
    
    public function setActive($a)
    {
    	$this->active = (bool) $a;
    }
    
    public function getActive()
    {
    	return $this->active;
    }
    
    public function setHomepage($home)
    {
    	$this->homepage = (bool) $home;
    }
    
    public function getHomepage()
    {
    	return $this->homepage;
    }
    
    public function getName()
    {
    	return $this->getTranslated('name');
    }
    
    public function getDescription()
    {
    	return $this->getTranslated('description');
    }

}