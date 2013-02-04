<?php
/**
 * This file is part of the Taco Projects.
 *
 * Copyright (c) 2004, 2013 Martin Takáč (http://martin.takac.name)
 *
 * For the full copyright and license information, please view
 * the file LICENCE that was distributed with this source code.
 *
 * PHP version 5.3
 *
 * @author     Martin Takáč (martin@takac.name)
 */


namespace Taco\Utils\i18n;


/**
 * Interface of provider.
 */
interface IProvider
{

	/**
	 * Lookup a message in the current domain
	 *
	 * @param string $message
	 *
	 * @return string
	 */
	function gettext($message);


	/**
	 * Plural version of gettext.
	 *
	 * @param string $singular
	 * @param string $plural
	 * @param int $count (positive number)
	 *
	 * @return string
	 */
	function ngettext($singular, $plural, $count);


}
