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

namespace Axstrad\DoctrineExtensions\Activatable\Mapping\Driver;

use Axstrad\DoctrineExtensions\Activatable\Mapping\Validator;
use Axstrad\DoctrineExtensions\Exception\InvalidMappingException;
use Gedmo\Mapping\Driver;
use Gedmo\Mapping\Driver\File;

/**
 * Axstrad\DoctrineExtensions\Activatable\Mapping\Driver\Yaml
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/DoctrineExtensions
 * @subpackage Activatable
 */
class Yaml extends File implements Driver
{
    /**
     * File extension
     * @var string
     */
    protected $_extension = '.dcm.yml';

    /**
     * {@inheritDoc}
     */
    public function readExtendedMetadata($meta, array &$config)
    {
        $mapping = $this->_getMapping($meta->name);

        if (isset($mapping['axstrad'])) {
            $classMapping = $mapping['axstrad'];
            if (isset($classMapping['activatable'])) {
                $config['activatable'] = true;

                if ( ! isset($classMapping['activatable']['field_name'])) {
                    throw new InvalidMappingException('Field name for Activatable class is mandatory.');
                }

                $fieldName = $classMapping['activatable']['field_name'];

                Validator::validateField($meta, $fieldName);

                $config['fieldName'] = $fieldName;
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function _loadMappingFile($file)
    {
        return \Symfony\Component\Yaml\Yaml::parse($file);
    }
}
