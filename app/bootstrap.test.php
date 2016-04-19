<?php
require_once __DIR__ . '/autoload.php';
require_once __DIR__ . '/AppKernel.php';

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;

echo "[".date("Y-m-d H:i:s")."] Boostrapping test environment\n";

$kernel = new AppKernel('test', true); // create a "test" kernel
$kernel->boot();

$application = new Application($kernel);
$application->setAutoExit(false);

echo "[".date("Y-m-d H:i:s")."] Kernel ready\n";

deleteDatabase();

executeCommand($application, "doctrine:schema:create");
echo "[".date("Y-m-d H:i:s")."] Database schema created\n";

executeCommand($application, "doctrine:fixtures:load", [
	"--fixtures" => __DIR__ . "/../tests/Fixtures/DataFixtures",
	"--no-interaction" => 1,
]);
echo "[".date("Y-m-d H:i:s")."] Fixtures loaded\n";

backupDatabase();

function executeCommand($application, $command, array $options = [])
{
	$options["--env"] = "test";
	$options["--quiet"] = true;
	$options = array_merge($options, array('command' => $command));

	$application->run(new ArrayInput($options));
}

function deleteDatabase()
{
	$folder = __DIR__ . '/../var/cache/test/';
	foreach (['test.db', 'test.db.bk'] as $file) {
		if (file_exists($folder . $file)) {
			unlink($folder . $file);
		}
	}
}

function backupDatabase()
{
	copy(__DIR__ . '/../var/cache/test/test.db', __DIR__ . '/../var/cache/test/test.db.bk');
}

function restoreDatabase()
{
	copy(__DIR__ . '/../var/cache/test/test.db.bk', __DIR__ . '/../var/cache/test/test.db');
}