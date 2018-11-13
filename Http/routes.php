<?php

/**
 * Set the default documentation version...
 */
if (! defined('DEFAULT_VERSION')) {
    define('DEFAULT_VERSION', '1.0');
}

if (! defined('DEFAULT_LANG')) {
    define('DEFAULT_LANG', 'en');
}

Route::group(['middleware' => 'web', 'prefix' => 'docs', 'namespace' => 'Modules\Docs\Http\Controllers'], function()
{
    Route::get('/', 'DocsController@index');

    Route::get('{version}/{lang}/{page?}', 'DocsController@show');
});
