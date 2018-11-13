<?php

namespace Modules\Docs\Entities;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Cache\Repository as Cache;

class Documentation
{
    /**
     * The filesystem implementation.
     *
     * @var Filesystem
     */
    protected $files;

    /**
     * The cache implementation.
     *
     * @var Cache
     */
    protected $cache;

    /**
     * Create a new documentation instance.
     *
     * @param  Filesystem  $files
     * @param  Cache  $cache
     * @return void
     */
    public function __construct(Filesystem $files, Cache $cache)
    {
        $this->files = $files;
        $this->cache = $cache;
    }

    /**
     * Get the documentation index page.
     *
     * @param  string  $version
     * @return string
     */
    public function getIndex($version, $lang = 'en')
    {
        return $this->cache->remember('docs.'.$version.'.'.$lang.'.index', 5, function () use ($version, $lang) {
            $path = module_path('Docs') . '/Resources/docs/'.$version.'/'. $lang . '/documentation.md';

           
            if ($this->files->exists($path)) {
                return $this->replaceLinks($version, markdown($this->files->get($path)), $lang);
            }

            return null;
        });
    }

    /**
     * Get the given documentation page.
     *
     * @param  string  $version
     * @param  string  $page
     * @return string
     */
    public function get($version, $page, $lang)
    {
        return $this->cache->remember('docs.'.$version.'.'. $lang . '.' .$page, 5, function () use ($version, $page, $lang) {
            $path = module_path('Docs') . '/Resources/docs/'.$version.'/'. $lang .'/'.$page.'.md';

            if ($this->files->exists($path)) {
                return $this->replaceLinks($version, markdown($this->files->get($path)), $lang);
            }

            return null;
        });
    }

    /**
     * Replace the version place-holder in links.
     *
     * @param  string  $version
     * @param  string  $content
     * @return string
     */
    public static function replaceLinks($version, $content, $lang)
    {
        $data = str_replace('{{version}}', $version, $content);
        $data = str_replace('{{lang}}', $lang, $data);
        $data = str_replace('{{baseUrl}}', url('/'), $data);
        //
        return $data;
    }

    /**
     * Check if the given section exists.
     *
     * @param  string  $version
     * @param  string  $page
     * @return boolean
     */
    public function sectionExists($version, $page, $lang = 'en')
    {
        return $this->files->exists(
            module_path('Docs') . '/Resources/docs/'.$version.'/'. $lang .'/'.$page.'.md'
        );
    }

    /**
     * Get the publicly available versions of the documentation
     *
     * @return array
     */
    public static function getDocVersions()
    {
        return [
            'master' => 'Master',
            '1.0' => '1.0',
        ];
    }
}
