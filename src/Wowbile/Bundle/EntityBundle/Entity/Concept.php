<?php

namespace Wowbile\Bundle\EntityBundle\Entity;

use Kailab\Bundle\SharedBundle\Entity\TranslatedEntity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Kailab\FrontendBundle\Asset\EntityAsset;

/**
 * @ORM\Entity(repositoryClass="Wowbile\Bundle\EntityBundle\Repository\ConceptRepository")
 * @ORM\Table(name="concept")
 */
class Concept extends TranslatedEntity
{

    const ORIENTATION_VERTICAL = 'vertical';
    const ORIENTATION_HORIZONTAL = 'horizontal';
    const ORIENTATION_BOTH = 'both';

    protected $locale;

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
     * @ORM\OneToMany(targetEntity="ConceptScreenshot", mappedBy="concept", cascade={"persist", "remove"})
     */
    protected $concept_screenshots;

    /**
     * @ORM\OneToMany(targetEntity="ConceptTranslation", mappedBy="concept", cascade={"persist", "remove"})
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
        $this->translations = new ArrayCollection();
        $this->concept_screenshots = new ArrayCollection();
        $this->active = true;
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
                return Concept::ORIENTATION_BOTH;
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

    public function getConceptScreenshots()
    {
        return $this->concept_screenshots;
    }

    public function setConceptScreenshots($screens)
    {
        $this->concept_screenshots = $screens;
    }

    public function getScreenshot()
    {
        $screens = $this->getScreenshots();
        return $screens->first();
    }

    public function getScreenshots()
    {
        $screens = new ArrayCollection();
        foreach($this->concept_screenshots as $concept_screen){
            if($concept_screen instanceof ConceptScreenshot){
                $screens[] = $concept_screen->getScreenshot();
            }
        }
        return $screens;
    }

    public function setScreenshots(Collection $screens)
    {
        // clear old screenshots
        foreach($this->concept_screenshots as $v){
            $v->setConcept(null);
        }
        $k = 0;
        foreach($screens as $screen){
            $concept_screen = new ConceptScreenshot();
            $concept_screen->setScreenshot($screen);
            $concept_screen->setConcept($this);
            $concept_screen->setPosition($k++);
            $this->concept_screenshots[] = $concept_screen;
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

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
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

