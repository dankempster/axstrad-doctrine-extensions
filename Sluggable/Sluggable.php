<?php
/**
 * This file is part of the Axstrad library.
 *
 * (c) Dan Kempster <dev@dankempster.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright 2014-2015 Dan Kempster <dev@dankempster.co.uk>
 */

namespace Axstrad\DoctrineExtensions\Sluggable;

use Gedmo\Sluggable\Sluggable as BaseInterface;


/**
 * Axstrad\DoctrineExtensions\Sluggable\Sluggable
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/DoctrineExtensions
 * @subpackage Sluggable
 */
interface Sluggable extends BaseInterface
{
    /**
     * @return string
     */
    public function getSlug();
}
