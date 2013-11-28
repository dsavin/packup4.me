<?php

/**
 * Bag form.
 *
 * @package    packup4me
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AddItemsBagForm extends BaseBagForm
{
    public function configure()
    {
        unset(
        $this['created_at'], $this['updated_at'],
        $this['hash'], $this['description'], $this['preset_id']
        );

        $this->widgetSchema['items_list'] = new sfWidgetFormDoctrineChoiceWithParams(array(
            'model'  => 'Item',
            'multiple' => true,
            'expanded' => true,
            'table_method' => array('method' => 'getFreeItemsForBag', 'parameters' => array($this->getOption('bag_id'))),
        ));


        $this->widgetSchema->setLabels(array(
            'items_list'       => '',
        ));
    }
}
