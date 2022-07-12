<?php

namespace TwentySixB\LaravelPermissions;

use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\LaravelPackageTools\Package;
use TwentySixB\LaravelPermissions\Http\Livewire\Editor;
use Livewire\Livewire;

/**
 * Package Service Provider
 *
 */
class PermissionsServiceProvider extends PackageServiceProvider
{

    /**
     * @inheritDoc
     *
     * @param Package $package
     * @return void
     */
    public function configurePackage(Package $package) : void
    {
        $package->name('laravel-permissions')
            ->hasConfigFile()
            ->hasViews('permissions');
    }

    /**
     * @inheritDoc
     *
     * @return void
     */
    public function packageBooted() : void
    {
        Livewire::component('permissions.editor', Editor::class);
    }
}
