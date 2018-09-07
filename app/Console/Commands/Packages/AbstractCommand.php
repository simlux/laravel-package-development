<?php declare(strict_types=1);

namespace Simlux\LaravelPackageDevelopment\Console\Commands\Packages;

use Illuminate\Console\Command;

/**
 * Class AbstractCommand
 *
 * @package Simlux\LaravelPackageDevelopment\Console\Commands\Packages
 */
abstract class AbstractCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'package';

    /**
     * @var string
     */
    protected $description = '';

    abstract public function handle(): void;
}
