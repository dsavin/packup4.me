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
        $this->bag = Doctrine::getTable('Bag')->findOneBy('hash', $request->getParameter('hash'));
        $this->forward404Unless($this->bag);
        $this->free_items = Doctrine_Query::create()
            ->from('Item i')
            ->leftJoin('i.Bags b')
            ->where('b.id = ?', $this->bag->getId())
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

            $this->getRequest()->setParameter('hash',$bag->getHash());

            $this->forward('default','bag');

        }
    }



}
