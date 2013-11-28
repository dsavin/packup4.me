<?php

/**
 * ItemTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ItemTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object ItemTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Item');
    }

    public function getFreeItemsForBag($bagId) {
        $results = Doctrine_Query::create()
            ->from('Item i')
            ->where('i.id NOT IN (SELECT BagItem.item_id FROM BagItem WHERE BagItem.bag_id = ?)', $bagId)
            ->execute();

        return $results;
    }
}