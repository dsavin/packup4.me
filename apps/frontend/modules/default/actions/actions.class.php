<?php

/**
 * default actions.
 *
 * @package    packup4me
 * @subpackage default
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class defaultActions extends sfActions
{
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request)
    {
        $this->form = new BagForm();

        if($request->getPostParameter('bag')) {

            $this->processForm($request, $this->form);

        }
    }

    public function executeBag(sfWebRequest $request)
    {
        $this->bag = Doctrine::getTable('Bag')->findOneByHash($request->getParameter('hash'));

        $this->forward404Unless($this->bag);
        $this->free_items = Doctrine_Query::create()
            ->from('Item i')
            ->where('i.id NOT IN (SELECT BagItem.item_id FROM BagItem WHERE BagItem.bag_id = ?)', $this->bag->getId())
            ->execute();

    }


    protected function processForm(sfWebRequest $request, sfForm $form)
    {

        $form->bind(
            $request->getParameter($form->getName())
        );

        if ($form->isValid())
        {

            $bag = $form->save();

            if($bag->getPreset()):

                $bagItemsCollection = new Doctrine_Collection('Item');

                $presetCollection  = $bag->getPreset()->getItems();

                foreach ($presetCollection as $i => $item) {
                    $bagItemsCollection->add($item);
                }

                $bag
                    ->setItems($bagItemsCollection)
                    ->setPreset(null)
                    ->save();
            endif;

            $this->getRequest()->setParameter('hash',$bag->getHash());

            $this->forward('default','bag');

        }
    }

    public function executeError404(){

    }



}
