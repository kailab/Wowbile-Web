<?php

namespace Wowbile\Bundle\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Kailab\FrontendBundle\Asset\EntityAsset;

/**
 * @ORM\Entity(repositoryClass="Kailab\FrontendBundle\Repository\ConceptRepository")
 * @ORM\Table(name="concept_screenshot")
 */
class ConceptScreenshot
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Concept", inversedBy="concept_screenshots")
     * @ORM\JoinColumn(name="concept_id", referencedColumnName="id", onDelete="CASCADE", onUpdate="CASCADE")
     */
    protected $concept;

    /**
     * @ORM\ManyToOne(targetEntity="Screenshot", inversedBy="concept_screenshots")
     * @ORM\JoinColumn(name="screenshot_id", referencedColumnName="id", onDelete="CASCADE", onUpdate="CASCADE")
     */
    protected $screenshot;

    /**
     * @ORM\Column(type="integer")
     */
    protected $position;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function setPosition($k)
    {
        $this->position = intval($k);
    }

    public function getConcept()
    {
        return $this->concept;
    }

    public function setConcept($concept)
    {
        $this->concept = $concept;
    }

    public function getScreenshot()
    {
        return $this->screenshot;
    }

    public function setScreenshot($screen)
    {
        $this->screenshot = $screen;
    }

}
 
