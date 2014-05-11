<?php

$__boot = function() {
	if (isset($_SERVER['argv'][1]) && $_SERVER['argv'][1] === 'legacy') {
		$argv0 = './typo3/cli_dispatch.phpsh';
		$pwd = __DIR__ . '/../../../../typo3';
		$_SERVER['PHP_SELF'] = $pwd;
		chdir($pwd);
		$_SERVER['PHP_SELF'] =
		$_SERVER['PATH_TRANSLATED'] =
		$_SERVER['SCRIPT_FILENAME'] =
		$_SERVER['SCRIPT_NAME'] = $argv0;
		$_SERVER['argv'] = array_slice($_SERVER['argv'], 2);
		array_unshift($_SERVER['argv'], $argv0);

		define('PATH_site', realpath(__DIR__ . '/../../../../') . '/');
		define('PATH_thisScript', realpath(__DIR__ . '/../../../../' . $argv0));
		require __DIR__ . '/../Scripts/CliDispatch.php';
		exit(0);
	} else {
		// TODO: If we find a more reliable way finding this path it would be nice
		// Maybe add the possibiliy to get this from env
		define('PATH_site', realpath(__DIR__ . '/../../../../') . '/');
		define('PATH_thisScript', realpath(__DIR__ . '/../../../../typo3cms'));
	}

	require PATH_site . 'typo3/sysext/core/Classes/Core/Bootstrap.php';
	require __DIR__ . '/../Classes/Core/ConsoleBootstrap.php';
	require PATH_site . 'typo3/sysext/core/Classes/Core/ApplicationContext.php';

	$context = getenv('TYPO3_CONTEXT') ?: (getenv('REDIRECT_TYPO3_CONTEXT') ?: 'Production');
	$bootstrap = new \Helhum\Typo3Console\Core\ConsoleBootstrap($context);
	$bootstrap->run();
};

$__boot();