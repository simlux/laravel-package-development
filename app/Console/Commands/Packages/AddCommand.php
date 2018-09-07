<?php declare(strict_types=1);

namespace Simlux\LaravelPackageDevelopment\Console\Commands\Packages;

/**
 * Class AddCommand
 *
 * @package Simlux\LaravelPackageDevelopment\Console\Commands\Packages
 */
class AddCommand extends AbstractCommand
{
    const ARGUMENT_REPOSITORY = 'repository';

    /**
     * @var string
     */
    protected $signature = 'package:add {repository}';

    /**
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @return void
     */
    public function handle(): void
    {
        $repository  = $this->argument(self::ARGUMENT_REPOSITORY);
        $packageName = $this->getPackageName($repository);
        if (is_dir(base_path('packages/' . $packageName))) {
            $this->error('Directory already exists. Aborted!');
            exit;
        }
        $command = sprintf('git submodule add -f %s packages/%s', $repository, $packageName);
        $this->info(sprintf('EXECUTING: %s', $command));
        $output = [];
        system($command, $output);
    }

    /**
     * @param string $repository
     *
     * @return string
     */
    private function getPackageName(string $repository): string
    {
        $parts = explode('/', $repository);

        return str_replace('.git', '', end($parts));
    }
}
