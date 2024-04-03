<?php
	/**
	 * Copyright (C) ZubDev Digital Media - All Rights Reserved
	 *
	 * File: Smartie.php
	 * Author: Zubayr Ganiyu
	 *   Email: <seunexseun@gmail.com>
	 *   Website: https://zubdev.net
	 * Date: 3/26/24
	 * Time: 10:40 PM
	 */


	namespace Seunex17\Codeigniter4Smarty\Config;

	use CodeIgniter\Config\BaseConfig;

	class Smartie extends BaseConfig {

		/**
		 * If you like to use theming
		 *
		 * You can change this to true or false
		 *
		 * @var bool
		 */
		public bool $enableTheme = false;

		/**
		 * This allow you to set your default template directory
		 * Make sure the directory exist in your view
		 * @var array|string[]
		 */
		public array $templates = ['default'];

		/**
		 * This allow you to set your current theme directory
		 * @var string
		 */
		public string $activeTheme = 'default';

		/**
		 * As at Smarty V5 native or custom php function
		 * are no longer allow in template view
		 *
		 * You need to register every function you need in your view here
		 * @var array
		 */
		public array $modifiers = [];

	}