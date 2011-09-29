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
 * @ORM\Entity(repositoryClass="Wowbile\Bundle\EntityBundle\Repository\CustomerRepository")
 * @ORM\Table(name="customer")
 */
class Customer extends TranslatedEntity
{
    const ORIENTATION_VERTICAL = 'vertical';
    const ORIENTATION_HORIZONTAL = 'horizontal';
    const ORIENTATION_BOTH = 'both';
    
    protected $image = null;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length="255", unique=true)
     */
    protected $slug;

    /**
     * @ORM\Column(type="integer")
     */
    protected $position;

    /**
     * @ORM\Column(type="string", length="50", nullable=true)
     */
    protected $type;

    /**
     * @ORM\Column(type="string", length="255", nullable=true)
     */
    protected $url;

    /**
     * @ORM\OneToMany(targetEntity="CustomerScreenshot", mappedBy="customer", cascade={"persist", "remove"})
     */
    protected $customer_screenshots;

    /**
     * @ORM\OneToMany(targetEntity="CustomerTranslation", mappedBy="customer", cascade={"persist", "remove"})
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
     * @ORM\ManyToMany(targetEntity="Platform", inversedBy="customers")
     * @ORM\JoinTable(name="customer_platform",
     *      joinColumns={@ORM\JoinColumn(name="customer_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="platform_id", referencedColumnName="id")}
     *      )
     */
    protected $platforms;

    /**
     * @ORM\ManyToMany(targetEntity="Customer")
     * @ORM\JoinTable(name="customer_relation",
     *      joinColumns={@ORM\JoinColumn(name="customer_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="related_id", referencedColumnName="id")}
     *      )
     */
    protected $related;

    function __construct()
    {
        parent::__construct();
        $this->loadAssets();
        $this->customer_screenshots = new ArrayCollection();
        $this->platforms = new ArrayCollection();
        $this->related = new ArrayCollection();
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
    	$resize = new Resize(new Box(125,125));
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

    public function getOrientation()
    {
        $shots = $this->getScreenshots();

        $h = null;
        foreach($shots as $shot){
            if($shot->getOrientation() != $h && $h != null){
                return Customer::ORIENTATION_BOTH;
            }
            $h = $shot->getOrientation();
        }
        return $h;
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

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getCustomerScreenshots()
    {
        return $this->customer_screenshots;
    }

    public function setCustomerScreenshots($screens)
    {
        $this->customer_screenshots = $screens;
    }

    public function getScreenshot()
    {
        $screens = $this->getScreenshots();
        return $screens->first();
    }

    public function getScreenshots()
    {
        $screens = new ArrayCollection();
        foreach($this->customer_screenshots as $customer_screen){
            if($customer_screen instanceof CustomerScreenshot){
                $screens[] = $customer_screen->getScreenshot();
            }
        }
        return $screens;
    }

    public function setScreenshots(Collection $screens)
    {
        // clear old screenshots
        foreach($this->customer_screenshots as $v){
            $v->setCustomer(null);
        }
        $k = 0;
        foreach($screens as $screen){
            $customer_screen = new CustomerScreenshot();
            $customer_screen->setScreenshot($screen);
            $customer_screen->setCustomer($this);
            $customer_screen->setPosition($k++);
            $this->customer_screenshots[] = $customer_screen;
        }
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

    public function getLinks()
    {
    	return $this->getTranslated('links');
    }

    public function getExcerpt()
    {
    	return $this->getTranslated('excerpt');
    }

    public function getRelated()
    {
        return $this->related;
    }

    public function setRelated($customers)
    {
        $this->related = $customers;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getPlatforms()
    {
        return $this->platforms;
    }

    public function setPlatforms($platforms)
    {
        $this->platforms = $platforms;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }
}

