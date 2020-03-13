<?php

/*
 * This file is part of Oveleon glossary bundle.
 *
 * (c) https://www.oveleon.de/
 */

// Add palettes to tl_page
$GLOBALS['TL_DCA']['tl_page']['palettes']['duplicate'] = '{title_legend},title,alias,type;{meta_legend},pageTitle,robots,description,serpPreview;{redirect_legend},jumpTo;{protected_legend:hide},protected;{cache_legend:hide},includeCache;{chmod_legend:hide},includeChmod;{expert_legend:hide},cssClass,sitemap,hide,noSearch,guests,requireItem;{tabnav_legend:hide},tabindex,accesskey;{publish_legend},published,start,stop';