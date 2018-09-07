<?php declare(strict_types=1);

namespace Simlux\LaravelPackageDevelopment\Console\Commands\Packages;

/**
 * Class RemoveCommand
 *
 * @package Simlux\LaravelPackageDevelopment\Console\Commands\Packages
 */
class RemoveCommand extends AbstractCommand
{
    const ARGUMENT_PACKAGE = 'package';

    /**
     * @var string
     */
    protected $signature = 'package:remove {package}';

    /**
     * @var string
     */
    protected $description = 'Removes a package from development.';

    /**
     * @return void
     */
    public function handle(): void
    {
        $package = $this->argument(self::ARGUMENT_PACKAGE);

        if (!is_dir(base_path('packages/' . $package))) {
            $this->error('Package does not exists. Aborted!');
            exit;
        }

        $command = sprintf('git rm packages/%s -f', $package);
        $this->info(sprintf('REMOVING PACKAGE: %s', $command));
        system($command);

        $command = sprintf('rm -rf .git/modules/%s', $package);
        $this->info(sprintf('REMOVING CONFIG: %s', $command));
        system($command);
    }
}
