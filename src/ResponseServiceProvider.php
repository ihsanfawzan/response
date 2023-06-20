<?php

namespace Response\Response;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Response\Response\Commands\ResponseCommand;

class ResponseServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('response')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_response_table')
            ->hasCommand(ResponseCommand::class);
    }
}
