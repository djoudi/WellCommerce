<?php
/*
 * WellCommerce Open-Source E-Commerce Platform
 *
 * This file is part of the WellCommerce package.
 *
 * (c) Adam Piotrowski <adam@wellcommerce.org>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace WellCommerce\Bundle\CoreBundle\Form\Elements\Fixed;

use Symfony\Component\OptionsResolver\OptionsResolver;
use WellCommerce\Bundle\CoreBundle\Form\Elements\AbstractField;
use WellCommerce\Bundle\CoreBundle\Form\Elements\ElementInterface;
use WellCommerce\Bundle\CoreBundle\Form\Filters\FilterInterface;

/**
 * Class AbstractFixedField
 *
 * @author Adam Piotrowski <adam@wellcommerce.org>
 */
abstract class AbstractFixedField extends AbstractField implements ElementInterface
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setNormalizer('property_path', function ($options) {
            return null;
        });
    }
    /**
     * {@inheritdoc}
     */
    public function addFilter(FilterInterface $filter)
    {
        return false;
    }
}
