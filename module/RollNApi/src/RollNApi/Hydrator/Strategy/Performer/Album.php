<?php

namespace RollNApi\Hydrator\Strategy\Performer;

use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;
use DoctrineModule\Stdlib\Hydrator\Strategy\AbstractCollectionStrategy;
use ZF\Hal\Collection;

/**
 * Class CollectionExtract
 * A field-specific hydrator for collections.
 *
 * @returns HalCollection
 */
class Album extends AbstractCollectionStrategy implements StrategyInterface
{
    public function extract($value)
    {
        $value = ($value) ?: array();
        $halCollection = new Collection($value);

        return $halCollection;
    }

    public function hydrate($value)
    {
        $performerAlbums = $this->getObject()->getAlbum();

        // Remove all albums then add
        foreach ($performerAlbums as $album) {
            $this->getObject()->removeAlbum($album);
            $album->removePerformer($this->getObject());
        }

        foreach ($value as $album) {
            $album->addPerformer($this->getObject());
            $this->getObject()->addAlbum($album);
        }
    }
}
