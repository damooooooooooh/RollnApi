<?php

namespace RollNApi\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Loop
 */
class Loop
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $childLoop;

    /**
     * @var \RollNApi\Entity\Loop
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
     * @param \RollNApi\Entity\Loop $childLoop
     * @return Loop
     */
    public function addChildLoop(\RollNApi\Entity\Loop $childLoop)
    {
        $this->childLoop[] = $childLoop;

        return $this;
    }

    /**
     * Remove childLoop
     *
     * @param \RollNApi\Entity\Loop $childLoop
     */
    public function removeChildLoop(\RollNApi\Entity\Loop $childLoop)
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
     * @param \RollNApi\Entity\Loop $parentLoop
     * @return Loop
     */
    public function setParentLoop(\RollNApi\Entity\Loop $parentLoop = null)
    {
        $this->parentLoop = $parentLoop;

        return $this;
    }

    /**
     * Get parentLoop
     *
     * @return \RollNApi\Entity\Loop 
     */
    public function getParentLoop()
    {
        return $this->parentLoop;
    }
}
