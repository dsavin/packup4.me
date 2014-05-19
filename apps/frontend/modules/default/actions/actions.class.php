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
    public function preExecute() {
        $request = $this->getRequest();
        if($request->getRequestFormat() === 'json')
            $this->getResponse()->setContentType('application/json');
    }

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

    public function executeBag(sfWebRequest $request) {


        $this->bag = Doctrine::getTable('Bag')->findOneByHash($request->getParameter('hash'));

        $this->form = new AddItemsBagForm($this->bag, array('bag_id' => $this->bag->getId()));

        $this->forward404Unless($this->bag);
        $postForm = $request->getParameter($this->form->getName());

        if ($request->isMethod('post') && array_key_exists('items_list', $postForm)){
            $this->addItemsToBag($request);
        }
    }

    private function addItemsToBag($request) {

        $formArray = $request->getParameter($this->form->getName());

        $itemsArray = $formArray['items_list'];

        foreach ($itemsArray as $itemId) {
            $item = Doctrine::getTable('Item')->findOneById(intval($itemId));
            $this->bag->getItems()->add($item);
        }

        $this->bag->save();

    }


    private function processForm(sfWebRequest $request, sfForm $form)
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

    public function executeCreateBag(sfWebRequest $request) {
        //1.create bag
        //2.return bag items from preset and hash
        $bag = new Bag();
        $preset = PresetTable::getInstance()->findOneById($request->getParameter('preset_id'));
        $bag->setPreset($preset);
        $bag->save();
        
        return $this->renderText(json_encode(Array('hash' => $bag->getHash())));
    }

    public function executeBagItems(sfWebRequest $request) {
        $bag = BagTable::getInstance()->findOneByHash($request->getParameter('hash'));
        if($bag->getIsNew()) {
            $items = PresetTable::getInstance()->findOneById($bag->getPresetId())->getItems();
        } else {
            $items = $bag->getItems();
        }

        return $this->renderText(json_encode(Array('items' => $items->toArray())));   
    }

    public function executeError404() {

    }

    public function executePresetList(sfWebRequest $request) {
        $this->presets = PresetTable::getInstance()->findAll()->toArray();
        return $this->renderText(json_encode($this->presets));
    }



}
