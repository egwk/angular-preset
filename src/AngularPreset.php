<?php

namespace EGWK\AngularPreset;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Console\Presets\Preset;
use Illuminate\Support\Arr;

/**
 * User: Walter Ribeiro
 * Date: 12/10/2017
 */
class AngularPreset extends Preset
{
    /**
     * Install the preset.
     *
     * @return void
     */
    public static function install()
    {
        static::updatePackages();
        static::updateWebpackConfiguration();
        static::updateBootstrapping();
        static::ensureComponentDirectoryExists();
        static::updateComponent();
        static::removeNodeModules();
    }

    /**
     * Update the given package array.
     *
     * @param  array $packages
     * @return array
     */
    protected static function updatePackageArray(array $packages)
    {
        return [
                '@angular/common' => '^6.0.3',
                '@angular/compiler' => '^6.0.3',
                '@angular/core' => '^6.0.3',
                '@angular/forms' => '^6.0.3',
                '@angular/http' => '^6.0.3',
                '@angular/platform-browser' => '^6.0.3',
                '@angular/platform-browser-dynamic' => '^6.0.3',
                '@angular/router' => '^6.0.3',
                'core-js' => '^2.5.4',
                'rxjs' => '^6.0.0',
                'ts-loader' => '^4.4.2',
                'typescript' => '^3.0.1',
                'zone.js' => '^0.8.26',
                '@angular/animations' => '^6.0.3'
            ] + Arr::except($packages, ['axios', 'jquery', 'vue']);
    }

    /**
     * Update the Webpack configuration.
     *
     * @return void
     */
    protected static function updateWebpackConfiguration()
    {
        copy(__DIR__ . '/angular-stubs/webpack.mix.js', base_path('webpack.mix.js'));
    }

    /**
     * Update the example component.
     *
     * @return void
     */
    protected static function updateComponent()
    {
        (new Filesystem)->deleteDirectory(resource_path('assets/js/components'), true);

        copy(__DIR__ . '/angular-stubs/example.component.ts', resource_path('assets/js/components/example.component.ts'));
    }

    /**
     * Update the bootstrapping files.
     *
     * @return void
     */
    protected static function updateBootstrapping()
    {
        copy(__DIR__ . '/angular-stubs/main.ts', resource_path('assets/js/main.ts'));
        copy(__DIR__ . '/angular-stubs/app.module.ts', resource_path('assets/js/app.module.ts'));
        copy(__DIR__ . '/angular-stubs/environment.ts', resource_path('assets/js/environment.ts'));
        copy(__DIR__ . '/angular-stubs/tsconfig.json', resource_path('assets/js/tsconfig.json'));
    }
}