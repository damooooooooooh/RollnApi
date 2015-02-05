<?php

namespace RollNApi\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TestLoop
 */
class TestLoop
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $childLoop;

    /**
     * @var \RollNApi\Entity\TestLoop
     */
    private $parentLoop;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->childLoop = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     * @return TestLoop
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
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

    /**
     * Add childLoop
     *
     * @param \RollNApi\Entity\TestLoop $childLoop
     * @return TestLoop
     */
    public function addChildLoop(\RollNApi\Entity\TestLoop $childLoop)
    {
        $this->childLoop[] = $childLoop;

        return $this;
    }

    /**
     * Remove childLoop
     *
     * @param \RollNApi\Entity\TestLoop $childLoop
     */
    public function removeChildLoop(\RollNApi\Entity\TestLoop $childLoop)
    {
        $this->childLoop->removeElement($childLoop);
    }

    /**
     * Get childLoop
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildLoop()
    {
        return $this->childLoop;
    }

    /**
     * Set parentLoop
     *
     * @param \RollNApi\Entity\TestLoop $parentLoop
     * @return TestLoop
     */
    public function setParentLoop(\RollNApi\Entity\TestLoop $parentLoop = null)
    {
        $this->parentLoop = $parentLoop;

        return $this;
    }

    /**
     * Get parentLoop
     *
     * @return \RollNApi\Entity\TestLoop 
     */
    public function getParentLoop()
    {
        return $this->parentLoop;
    }
}
