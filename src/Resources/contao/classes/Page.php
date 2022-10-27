<?php

/*
 * This file is part of Oveleon page duplicate bundle.
 *
 * (c) https://www.oveleon.de/
 */

namespace Oveleon\ContaoPageDuplicateBundle;

use Contao\Frontend;
use Contao\PageModel;
use Database\Result;

/**
 * Provide methods regarding page duplicates.
 *
 * @author Fabian Ekert <https://github.com/eki89>
 */
class Page extends Frontend
{
    /**
     * Add page duplicates to the indexer
     *
     * @param array   $arrPages
     * @param integer $intRoot
     * @param boolean $blnIsSitemap
     *
     * @return array
     */
    public function getSearchablePages($arrPages, $intRoot=0, $blnIsSitemap=false)
    {
        // Get all page duplicates
        $objPages = $this->findPageDuplicates();

        // Walk through each page
        if (null !== $objPages)
        {
            while ($objPages->next())
            {
                $objPage = $objPages->current();

                // Skip pages without target page
                if (!$objPage->jumpTo)
                {
                    continue;
                }

                if ($blnIsSitemap)
                {
                    // Page is protected
                    if ($objPage->protected)
                    {
                        continue;
                    }

                    // Page is exempt from the sitemap
                    if ($objPage->robots == 'noindex,nofollow')
                    {
                        continue;
                    }

                    if ($objPage->sitemap == 'map_never')
                    {
                        continue;
                    }
                }

                $arrPages[] = $objPage->getAbsoluteUrl();
            }
        }

        return $arrPages;
    }

    /**
     * Calculate the page status icon name for duplicate page type
     *
     * @param PageModel|Result|\stdClass $objPage The page object
     * @param string                     $image   Image file name
     *
     * @return string The status icon path
     */
    public function getPageDuplicateStatusIcon($objPage, $image)
    {
        if ('duplicate' !== $objPage->type)
        {
            return $image;
        }

        return 'bundles/contaopageduplicate/' . str_replace('regular', 'duplicate', $image);;
    }

    private function findPageDuplicates()
    {
        $t = 'tl_page';
        $arrColumns = ["$t.type='duplicate' AND $t.protected='' AND $t.published='1'"];

        return PageModel::findBy($arrColumns, []);
    }
}