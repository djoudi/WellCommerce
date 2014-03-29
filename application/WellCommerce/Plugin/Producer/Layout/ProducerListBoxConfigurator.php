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

namespace WellCommerce\Plugin\Producer\Layout;

use WellCommerce\Core\Form;
use WellCommerce\Core\Layout\Box\LayoutBoxConfigurator;

/**
 * Class ProducerBoxConfigurator
 *
 * @package WellCommerce\Plugin\Producer\Layout
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class ProducerListBoxConfigurator extends LayoutBoxConfigurator
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Producer list';
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return 'wellcommerce.box.producer_list';
    }

    /**
     * {@inheritdoc}
     */
    public function isAvailableForLayoutPage($layoutPage)
    {
        return ($layoutPage == 'ProducerList');
    }

    /**
     * {@inheritdoc}
     */
    public function getConfigurationFields(Form\Elements\Form $form)
    {
        return false;
    }
} 