<?php
	/**
	 * Copyright (C) ZubDev Digital Media - All Rights Reserved
	 *
	 * File: Smartie.php
	 * Author: Zubayr Ganiyu
	 *   Email: <seunexseun@gmail.com>
	 *   Website: https://zubdev.net
	 * Date: 3/25/24
	 * Time: 3:20 PM
	 */


	namespace Seunex17\Codeigniter4Smarty\Template;

	use phpDocumentor\Reflection\Types\Self_;
	use Smarty\Smarty;

	class Smartie {
		private static Smarty $smarty;


		/**
		 * @throws \Smarty\Exception
		 */
		public static function view($template, array $data = [])
		: string {

			helper([
				'setting',
			]);

			// Initialize smarty template engin
			static::$smarty = new Smarty();

			// Set smarty template directory
			if (setting('Smartie.enableTheme'))
			{
				self::$smarty->setTemplateDir(APPPATH . "Views/". setting()->get('Smartie.activeTemplate'));
			} else {
				self::$smarty->setTemplateDir(APPPATH . "Views/");
			}

			// Set smarty compile directory
			self::$smarty->setCompileDir(WRITEPATH . "templates_c");

			//* Enable modifiers
			$modifiers = setting('Smartie.modifiers');
			if ($modifiers)
			{
				foreach ($modifiers as $modifier)
				{
					self::$smarty->registerPlugin('modifier', $modifier, $modifier);
				}
			}

			//* Global variables
			$globalVariables = setting('Smartie.globalVariables');
			if ($globalVariables)
			{
				foreach($globalVariables as $key => $value)
				{
					Self_:self::$smarty->assign($key, $value);
				}
			}

			// Make sure our compile directory is writable
			// If not writable we need to set the write permission.
			if (!is_writable(self::$smarty->getCompileDir()))
			{
				// make sure to compile directory can be written to
				@chmod(self::$smarty->getCompileDir(), 0777);
			}

			// Smarty debug mode configuration
			if (!self::$smarty->getDebug())
			{
				self::$smarty->setErrorReporting(false);
			}

			self::$smarty->error_unassigned = false;

			// Assign variable to smarty template view
			foreach ($data as $key => $val)
			{
				self::$smarty->assign($key, $val);
			}

			// Render template to view
			return self::$smarty->fetch(str_replace('.', '/', $template) . '.tpl');
		}

	}