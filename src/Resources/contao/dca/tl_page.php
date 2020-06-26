<?php

/*
 * This file is part of Oveleon glossary bundle.
 *
 * (c) https://www.oveleon.de/
 */

// Add palettes to tl_page
$GLOBALS['TL_DCA']['tl_page']['palettes']['duplicate'] = '{title_legend},title,alias,type;{meta_legend},pageTitle,robots,description,serpPreview;{duplicate_legend},jumpTo;{protected_legend:hide},protected;{layout_legend:hide},includeLayout;{cache_legend:hide},includeCache;{chmod_legend:hide},includeChmod;{expert_legend:hide},cssClass,sitemap,hide,noSearch;{tabnav_legend:hide},tabindex,accesskey;{publish_legend},published,start,stop';

$GLOBALS['TL_DCA']['tl_page']['config']['onload_callback'][] = array('tl_page_duplicate', 'makePageDuplicateMandatory');

/**
 * Provide miscellaneous methods that are used by the data configuration array.
 *
 * @author Fabian Ekert <https://github.com/eki89>
 */
class tl_page_duplicate extends Contao\Backend
{
    /**
     * Make the page mandatory if the page is a page duplicate
     *
     * @param Contao\DataContainer $dc
     *
     * @throws Exception
     */
    public function makePageDuplicateMandatory(Contao\DataContainer $dc)
    {
        $objPage = $this->Database->prepare("SELECT * FROM " . $dc->table . " WHERE id=?")
            ->limit(1)
            ->execute($dc->id);

        if ($objPage->numRows && $objPage->type == 'duplicate')
        {
            $GLOBALS['TL_DCA']['tl_page']['fields']['jumpTo']['eval']['mandatory'] = true;
            $GLOBALS['TL_DCA']['tl_page']['fields']['jumpTo']['label'] = &$GLOBALS['TL_LANG']['tl_page']['jumpToDuplicate'];
        }
    }
}