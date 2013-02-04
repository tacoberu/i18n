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


use UnexpectedValueException;


/**
 * Gettext provider.
 */
class GettextProvider implements IProvider
{


	/**
	 * Translator contructor.
	 *
	 * @param string $project Nazev projektu, podle ktereho se jmenuje i soubor.
	 * @param string $path Cesta k adresari s lokalizacemi: <app/locale>/cs/LC_MESSAGES/project.mo
	 * @param string $locale cs_CZ | en_GB | de_DE
	 * @param string $codeset utf8
	 */
	public function __construct($project, $path, $locale, $codeset = 'utf8')
	{
		$path = realpath($path);

		if (!is_readable($path)) {
			throw new UnexpectedValueException("Path [$path] is not readable.");
		}
		if (!file_exists($path . DIRECTORY_SEPARATOR . $locale
					. DIRECTORY_SEPARATOR . 'LC_MESSAGES'
					. DIRECTORY_SEPARATOR . $project . '.mo')) {
			throw new UnexpectedValueException('File with locale not found: ' . $path
					. DIRECTORY_SEPARATOR . $locale
					. DIRECTORY_SEPARATOR . 'LC_MESSAGES'
					. DIRECTORY_SEPARATOR . $project . '.mo');
		}

		// nastavení jazyku (ovlivňuje jméno složky, kde bude hledán překlad pro jazyk)
		if (0 !== strncmp(PHP_OS, 'WIN', 3)) {	// na Windows vyhazuje chyby
			$status1 = putenv('LANG=' . $locale);
			$status2 = putenv('LANGUAGE=' . $locale);
			putenv('LC_ALL=' . $locale);
			putenv('LC_MESSAGES=' . $locale);
		}

		// nastavuje jazykové prostředí
		$status4 = setlocale(LC_ALL, $locale . '.' . $codeset);
		$status4 = setlocale(LC_CTYPE, $locale . '.' . $codeset);

		// nastavuje kódování na UTF-8
		$status3 = bind_textdomain_codeset($project, $codeset);

		// nastavuje cestu k adresáři s lokalizacemi
		$status5 = bindtextdomain($project, $path);

		// spustí doménu s překlady
		$status6 = textdomain($project);
	}
	


	/*** IProvider **********************************************************/



	/**
	 * Lookup a message in the current domain
	 *
	 * @param string $message
	 *
	 * @return string
	 */
	public function gettext($message)
	{
		return gettext($message);	
	}



	/**
	 * Plural version of gettext.
	 *
	 * @param string $singular
	 * @param string $plural
	 * @param int $count (positive number)
	 *
	 * @return string
	 */
	public function ngettext($singular, $plural, $count)
	{
		return ngettext($message, $plural, $count);
	}




}
