<?php

namespace Wowbile\Bundle\EntityBundle\Entity;


use Kailab\Bundle\SharedBundle\Entity\TranslatedEntity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Kailab\Bundle\SharedBundle\Asset\EntityAsset;
use Kailab\Bundle\SharedBundle\Asset\ParameterAsset;
use Kailab\Bundle\SharedBundle\Imagine\Filter\Resize;

use Imagine\Gd\Imagine;
use Imagine\Image\Box;

/**
 * @ORM\Entity(repositoryClass="Wowbile\Bundle\EntityBundle\Repository\TestimonyRepository")
 * @ORM\Table(name="testimony")
 */
class Testimony extends TranslatedEntity
{
	protected $image = null;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length="255", nullable=true)
     */
    protected $url;
    
    /**
    * @ORM\Column(type="string", length="255", nullable=true)
    */
    protected $name;

    /**
    * @ORM\Column(type="string", length="255", nullable=true)
    */
    protected $company;

    /**
     * @ORM\OneToMany(targetEntity="TestimonyTranslation", mappedBy="testimony", cascade={"persist", "remove"})
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
    
    /**
    * @ORM\Column(type="integer")
    */
    protected $position;


    function __construct()
    {
    	$this->loadAssets();
        $this->translations = new ArrayCollection();
        $this->active = true;
    }
    
    protected function loadAssets()
    {
    	if(!$this->image instanceof EntityAsset){
    		$this->image = new EntityAsset($this, "image");
    	}
    }
    
    public function getAssets()
    {
    	$this->loadAssets();
    	return array($this->image);
    }
    
    public function updateAssets()
    {
    	$asset = $this->getImage();
    	if($asset == null){
    		return false;
    	}
    	$content = $asset->getContent();
    	if(!$content){
    		return false;
    	}
    	$imagine = new Imagine();
    	$img= $imagine->load($content);
    	$resize = new Resize(new Box(145,1000));
    	$img = $resize->apply($img);
    	
    	$this->setImage(new ParameterAsset(array(
    		'content'       => $img->get('png'),
    		'content_type'  => 'image/png'
    	)));
    }
    
    public function getImage()
    {
    	$this->loadAssets();
    	return $this->image;
    }
    
    public function setImage($path)
    {
    	$img = $this->getImage();
    	if($img == null){
    		return;
    	}
    	$img->setAsset($path);
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
        return $this->name;
    }
    
    public function setName($name)
    {
    	$this->name = $name;
    }

    public function getCompany()
    {
    	return $this->company;
    }
    
    public function setCompany($company)
    {
    	$this->company = $company;
    }
    
    public function getDescription()
    {
    	return $this->getTranslated('description');
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
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
    
    public function getInfo()
    {
    	$name = $this->getName();
    	$company = $this->getCompany();
    	$url = $this->getUrl();
    	if($company && $url){
    		$company = '<a href="'.$url.'" target="_blank">'.$company.'</a>';
    	}else if($name && $url){
    		$name = '<a href="'.$url.'" target="_blank">'.$name.'</a>';
    	}
    	if($company){
    		$name .= ", ".$company;
    	}
    	return $name;
    }

}

