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


use Nette;
use \InvalidArgumentException;


/**
 *	Implementation translate method for Nette Framework.
 */
class NetteTranslator implements Nette\Localization\ITranslator
{

	/**
	 * @var IProvider
	 */
	private $provider;



	/**
	 * Dependence on the provider of translation.
	 *
	 * @param IProvider $provider
	 */
	public function __construct(IProvider $provider)
	{
		$this->provider = $provider;
	}



	/*** Nette\ITranslator ****************************************************/


	/**
	 *	Implementation translate method for Nette Framework.
	 */
	public function translate($message, $count = null)
	{
		if ($count > 0) {
			return $this->translator->ngettext($message, $message, $count);
		}
		else {
			return $this->translator->gettext($message);
		}
	}
}
