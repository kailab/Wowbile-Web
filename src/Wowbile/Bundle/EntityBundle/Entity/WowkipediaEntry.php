<?php

namespace Wowbile\Bundle\EntityBundle\Entity;

use Kailab\Bundle\SharedBundle\Entity\TranslatedEntity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Wowbile\Bundle\FrontendBundle\Entity\WowkipediaEntry
 *
 * @ORM\Table(name="wowkipedia")
 * @ORM\Entity(repositoryClass="Wowbile\Bundle\EntityBundle\Repository\WowkipediaEntryRepository")
 */
class WowkipediaEntry extends TranslatedEntity
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
    * @ORM\OneToMany(targetEntity="WowkipediaEntryTranslation", mappedBy="entry", cascade={"persist", "remove"})
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
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
    
    public function getExcerpt($max=50, $end='...')
    {
    	$desc = strip_tags($this->getDescription());
    	if(mb_strlen($desc)<$max){
    		return $desc;
    	}
    	$words = explode(" ", $desc);
    	$len = 0;
    	foreach($words as $k=>$word){
    		if($len>$max){
    			break;
    		}
    		$len += mb_strlen($word);
    	}
    	return implode(" ", array_slice($words,0,$k)).$end;
    }
    
    public function getLetter()
    {
    	$name = $this->getName();
    	if(mb_strlen($name)>0){
    		return mb_strtolower(mb_substr($name,0,1));
    	}
    }
    
    public function getSlug()
    {
    	$slug = strtolower($this->getName());
    	$slug = preg_replace('/[^a-z]/', '_', $slug);
    	return $slug;
    }
    
    public function getAnchor()
    {
    	return $this->getLetter().'-'.$this->getSlug();
    }

}