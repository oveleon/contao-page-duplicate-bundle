<?php

/*
 * This file is part of Oveleon page duplicate bundle.
 *
 * (c) https://www.oveleon.de/
 */

// Page types
$GLOBALS['TL_PTY']['duplicate'] = 'Oveleon\\ContaoPageDuplicateBundle\\PageDuplicate';

// Register hooks
$GLOBALS['TL_HOOKS']['getSearchablePages'][] = ['Oveleon\\ContaoPageDuplicateBundle\\Page', 'getSearchablePages'];
$GLOBALS['TL_HOOKS']['getPageStatusIcon'][]  = ['Oveleon\\ContaoPageDuplicateBundle\\Page', 'getPageDuplicateStatusIcon'];
