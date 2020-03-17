<?php

/*
 * This file is part of Oveleon page duplicate bundle.
 *
 * (c) https://www.oveleon.de/
 */

namespace Oveleon\ContaoPageDuplicateBundle;

use Contao\PageModel;
use Symfony\Component\HttpFoundation\Response;

/**
 * Provide methods to handle a duplicate front end page.
 *
 * @author Fabian Ekert <https://github.com/eki89>
 */
class PageDuplicate extends \PageRegular
{
    /**
     * Generate a duplicate page
     *
     * @param \PageModel $objPage
     * @param boolean   $blnCheckRequest
     */
    public function generate($objPage, $blnCheckRequest=false)
    {
        $this->prepare($objPage);

        $this->Template->output($blnCheckRequest);
    }

    /**
     * Return a response object
     *
     * @param \PageModel $objPage
     * @param boolean   $blnCheckRequest
     *
     * @return Response
     */
    public function getResponse($objPage, $blnCheckRequest=false)
    {
        $this->prepare($objPage);

        return $this->Template->getResponse($blnCheckRequest);
    }

    /**
     * Generate a duplicate page
     *
     * @param \PageModel $objPageDuplicate
     *
     * @internal Do not call this method in your code. It will be made private in Contao 5.0.
     */
    protected function prepare($objPageDuplicate)
    {
        /** @var \PageModel $objPage */
        global $objPage;

        $objPage->id = $objPageDuplicate->jumpTo;
        $objPage->pageTitle = $objPageDuplicate->pageTitle;
        $objPage->robots = $objPageDuplicate->robots;
        $objPage->description = $objPageDuplicate->description;

        $objPageTarget = \PageModel::findByPk($objPageDuplicate->jumpTo);

        $objPage->cssClass = $objPageTarget->cssClass . ' ' . $objPageDuplicate->cssClass;
        $objPage->guests = $objPageTarget->guests;
        $GLOBALS['TL_HEAD'][] = '<link rel="canonical" href="'.$objPageTarget->getAbsoluteUrl().'">';

        parent::prepare($objPage);
    }
}
