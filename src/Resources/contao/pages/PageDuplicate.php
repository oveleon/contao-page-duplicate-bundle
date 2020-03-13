<?php

/*
 * This file is part of Oveleon glossary bundle.
 *
 * (c) https://www.oveleon.de/
 */

namespace Oveleon\ContaoPageDuplicateBundle;

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
     * @param boolean    $blnCheckRequest
     */
    public function generate($objPage, $blnCheckRequest=false)
    {
        $objPage2 = \PageModel::findByPk($this->jumpTo);

        $objPage->pageTitle = $objPage2->pageTitle;
        $objPage->robots = $objPage2->robots;
        $objPage->description = $objPage2->description;

        $this->prepare($objPage);

        $this->Template->output($blnCheckRequest);
    }
}
