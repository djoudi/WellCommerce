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
namespace WellCommerce\Plugin\Layout\Form;

use WellCommerce\Core\Form;
use WellCommerce\Plugin\Category\Event\CategoryFormEvent;
use WellCommerce\Plugin\Layout\Event\LayoutPageFormEvent;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * Class LayoutPageTree
 *
 * @package WellCommerce\Plugin\Category\Form
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class LayoutPageTree extends Form
{

    /**
     * Fetches all registered subpages system-wide using GenericEvent
     *
     * @return array
     */
    private function getTreeItems()
    {
        $event = new GenericEvent();

        $this->getDispatcher()->dispatch(LayoutPageFormEvent::TREE_INIT_EVENT, $event);

        $items  = [];
        $themes = $this->get('layout_theme.repository')->getAllLayoutThemeToSelect();

        foreach ($themes as $themeId => $themeName) {

            $items[$themeId] = [
                'name'   => $themeName,
                'parent' => null,
                'weight' => 0
            ];

            foreach ($event->getArguments() as $id => $name) {
                $treeId         = sprintf('%s,%s', $themeId, $id);
                $items[$treeId] = [
                    'name'   => $this->trans($name),
                    'parent' => $themeId,
                    'weight' => 0
                ];
            }
        }

        return $items;
    }

    public function init($layoutPageData = Array())
    {
        $form = $this->addForm([
            'name'  => 'layout_page_tree',
            'class' => 'category-select',
        ]);

        $id     = $this->getParam('id');
        $page   = $this->getParam('page');
        $active = ($page == null) ? $id : sprintf('%s,%s', $id, $page);

        $form->addChild($this->addSortableList([
            'name'               => 'layout_page',
            'label'              => $this->trans('Pages'),
            'addLabel'           => $this->trans('Add layout_page'),
            'sortable'           => false,
            'selectable'         => false,
            'clickable'          => true,
            'deletable'          => false,
            'addable'            => false,
            'prevent_duplicates' => false,
            'items'              => $this->getTreeItems(),
            'onClick'            => 'openLayoutPageEditor',
            'active'             => $active,
            'clickable_root'     => false
        ]));

        $form->AddFilter($this->addFilterNoCode());
        $form->AddFilter($this->addFilterSecure());

        $event = new CategoryFormEvent($form, $layoutPageData);

        $this->getDispatcher()->dispatch(CategoryFormEvent::TREE_INIT_EVENT, $event);

        $form->Populate($event->getPopulateData());

        return $form;
    }
}
