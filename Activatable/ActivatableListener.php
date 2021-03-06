<?php
/**
 * This file is part of the Axstrad library.
 *
 * (c) Dan Kempster <dev@dankempster.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @package Axstrad\DoctineExtensions
 */
namespace Axstrad\DoctrineExtensions\Activatable;

use Doctrine\Common\EventArgs;
use Doctrine\Common\Persistence\Event\LoadClassMetadataEventArgs as CommonEventArgs;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs as OrmEventArgs;
use Gedmo\Mapping\MappedEventSubscriber;
use Axstrad\DoctrineExtensions\Exception\InvalidArgumentException;


/**
 * Axstrad\DoctrineExtensions\Activatable\ActivatableListener
 */
class ActivatableListener extends MappedEventSubscriber
{
    /**
     */
    public function getSubscribedEvents()
    {
        return array(
            'loadClassMetadata',
        );
    }

    /**
     * Mapps additional metadata
     *
     * @param EventArgs $eventArgs
     * @return void
     * @throws InvalidArgumentException IF $eventArgs is not an instance of
     *         Doctrine\Common\Persistence\Event\LoadClassMetadataEventArgs or
     *         Doctrine\ORM\Event\LoadClassMetadataEventArgs
     */
    public function loadClassMetadata(EventArgs $eventArgs)
    {
        if ( ! $eventArgs instanceof CommonEventArgs
            && ! $eventArgs instanceof OrmEventArgs
        ) {
            throw InvalidArgumentException::create(
                'Doctrine\Common\Persistence\Event\LoadClassMetadataEventArgs',
                $eventArgs
            );
        }
        $ea = $this->getEventAdapter($eventArgs);
        $this->loadMetadataForObjectClass($ea->getObjectManager(), $eventArgs->getClassMetadata());
    }

    /**
     * {@inheritDoc}
     */
    public function getNamespace()
    {
        return __NAMESPACE__;
    }
}
