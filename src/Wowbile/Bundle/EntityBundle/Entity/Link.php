<?php

namespace Wowbile\Bundle\EntityBundle\Entity;

use Kailab\Bundle\SharedBundle\Entity\TranslatedEntity;
use Kailab\Bundle\SharedBundle\Asset\EntityAsset;
use Kailab\Bundle\SharedBundle\Asset\ParameterAsset;
use Kailab\Bundle\SharedBundle\Imagine\Filter\Resize;

use Imagine\Gd\Imagine;
use Imagine\Image\Box;

use Doctrine\ORM\Mapping as ORM;

/**
 * Wowbile\Bundle\FrontendBundle\Entity\WowkipediaEntry
 *
 * @ORM\Table(name="link")
 * @ORM\Entity(repositoryClass="Wowbile\Bundle\EntityBundle\Repository\LinkRepository")
 */
class Link extends TranslatedEntity
{
	
	protected $image = null;
	
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
    * @ORM\Column(type="string", length="50", nullable=true)
    */
    protected $language;
    
    function __construct()
    {
    	parent::__construct();
    	$this->loadAssets();
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
    	$resize = new Resize(new Box(155,50));
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
    		$uri = $this->getImage()->getUri();
    		$name = $this->getName();
    		if($uri){
    			$content = '<img src="'.$uri.'" alt="'.$name.'"/>';
    		}else{
    			$content = $name;
    		}
	    	return '<a target="_blank" href="'.$this->getUrl().'" title="'.$name.'">'
	    		.$content.'</a>';
    	}catch(\Exception $e){
    		return $e->getMessage();
    	}
    }
    
    public function getLanguage()
    {
    	return $this->language;
    }
    
    public function setLanguage($lang)
    {
    	$this->language = $lang;
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