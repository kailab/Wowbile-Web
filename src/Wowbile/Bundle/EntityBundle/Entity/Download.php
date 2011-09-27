<?php

namespace Wowbile\Bundle\EntityBundle\Entity;

use Kailab\Bundle\SharedBundle\Entity\TranslatedEntity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Kailab\Bundle\SharedBundle\Asset\EntityAsset;

/**
 * @ORM\Entity(repositoryClass="Wowbile\Bundle\EntityBundle\Repository\DownloadRepository")
 * @ORM\Table(name="download")
 */
class Download extends TranslatedEntity
{
	
	protected $file = null;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $position;
    
    /**
    * @ORM\Column(type="string", length="50", nullable=true)
    */
    protected $language;

    /**
     * @ORM\Column(type="string", length="50", nullable=true)
     */
    protected $type;

    /**
     * @ORM\OneToMany(targetEntity="DownloadTranslation", mappedBy="download", cascade={"persist", "remove"})
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
    protected $active;

    function __construct()
    {
    	$this->loadAssets();
        $this->translations = new ArrayCollection();
        $this->active = true;
    }
    
    protected function loadAssets()
    {
    	if($this->file === null){
			$this->file = new EntityAsset($this, "file");
    	}
    }
    
    public function getAssets()
    {
    	$this->loadAssets();
    	return array($this->file);
    }
    
    public function getFile()
    {
    	$this->loadAssets();
		return $this->file;
    }
    
    public function setFile($path)
    {
    	$this->loadAssets();
    	$this->file->setAsset($path);
    	$this->updated = new \DateTime('now');
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function getName()
    {
        return $this->getTranslated('name');
    }

    public function getDescription()
    {
        return $this->getTranslated('description');
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function setPosition($pos)
    {
        $this->position = $pos;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setCreated($time)
    {
        $this->created = $time;
    }

    public function getUpdated()
    {
        return $this->updated;
    }

    public function setUpdated($time)
    {
        $this->updated = $time;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

}

