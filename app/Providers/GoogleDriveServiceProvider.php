<?php

namespace App\Providers;

use Google_Client;
use Google_Service_Drive;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;
use Masbug\Flysystem\GoogleDriveAdapter;
use League\Flysystem\Filesystem;


class GoogleDriveServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Storage::extend('google', function ($app, $config) {
			$client = new Google_Client();
			$client->setClientId($config['client_id']);
			$client->setClientSecret($config['client_secret']);
			$client->refreshToken($config['refresh_token']);
			$service = new Google_Service_Drive($client);
            $adapter = new GoogleDriveAdapter($service, $config['folder_id']);

			return new Filesystem($adapter);
		});
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
