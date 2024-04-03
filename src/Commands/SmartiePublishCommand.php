<?php
	/**
	 * Copyright (C) ZubDev Digital Media - All Rights Reserved
	 *
	 * File: SmartiePublishCommand.php
	 * Author: Zubayr Ganiyu
	 *   Email: <seunexseun@gmail.com>
	 *   Website: https://zubdev.net
	 * Date: 4/3/24
	 * Time: 10:09 PM
	 */


	namespace Seunex17\Codeigniter4Smarty\Commands;

	use CodeIgniter\CLI\BaseCommand;
	use CodeIgniter\CLI\CLI;
	use Config\Autoload;

	class SmartiePublishCommand extends BaseCommand {

		/**
		 * The group the command is lumped under
		 * when listing commands.
		 *
		 * @var string
		 */
		protected $group = 'Smartie';

		/**
		 * The Command's name
		 *
		 * @var string
		 */
		protected $name = 'smartie:publish';

		/**
		 * the Command's usage description
		 *
		 * @var string
		 */
		protected $usage = 'smartie:publish';

		/**
		 * the Command's short description
		 *
		 * @var string
		 */
		protected $description = 'Publish smarty functionality into the current application.';

		/**
		 * the Command's options description
		 *
		 * @var array
		 */
		protected $options = [
			'-f' => 'Force overwrite all existing files in destination',
		];

		/** @var string */
		protected string $sourcePath;

		/**
		 * {@inheritdoc}
		 */
		public function run(array $params)
		{
			$this->determineSourcePath();

			$this->publishConfig();
		}

		/**
		 * Publish config auth.
		 *
		 * @return mixed
		 */
		protected function publishConfig()
		{
			$path = "{$this->sourcePath}/Config/Smartie.php";

			$content = file_get_contents($path);
			$content = str_replace('namespace Seunex17\Codeigniter4Smarty\Config', "namespace Config", $content);
			$content = str_replace("use CodeIgniter\Config\BaseConfig;\n", '', $content);
			$content = str_replace('extends BaseConfig', "extends \Seunex17\Codeigniter4Smarty\Config\Smartie", $content);

			$namespace = defined('APP_NAMESPACE') ? APP_NAMESPACE : 'App';

			$this->writeFile("Config/Smartie.php", $content);
		}

		/**
		 * Determines the current source path from which all other files are located.
		 *
		 * @return mixed
		 */
		protected function determineSourcePath()
		{
			$this->sourcePath = realpath(__DIR__ . '/../');

			if ($this->sourcePath === '/' || empty($this->sourcePath)) {
				CLI::error('Unable to determine the correct source directory. Bailing.');
				exit();
			}
		}

		/**
		 * Write a file, catching any exceptions and showing a
		 * nicely formatted error.
		 *
		 * @return mixed
		 */
		protected function writeFile(string $path, string $content)
		{
			$config  = new Autoload();
			$appPath = $config->psr4[APP_NAMESPACE];

			$filename  = $appPath . $path;
			$directory = dirname($filename);

			if (! is_dir($directory)) {
				mkdir($directory, 0777, true);
			}

			if (file_exists($filename)) {
				$overwrite = (bool) CLI::getOption('f');

				if (! $overwrite && CLI::prompt("File '{$path}' already exists in destination. Overwrite?", ['n', 'y']) === 'n') {
					CLI::error("Skipped {$path}. If you wish to overwrite, please use the '-f' option or reply 'y' to the prompt.");
					return;
				}
			}

			if (write_file($filename, $content)) {
				CLI::write(CLI::color('Created: ', 'green') . $path);
			} else {
				CLI::error("Error creating {$path}.");
			}
		}


	}