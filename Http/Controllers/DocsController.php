<?php

namespace Modules\Docs\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Docs\Entities\Documentation;
use Symfony\Component\DomCrawler\Crawler;

class DocsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  Documentation  $docs
     * @return void
     */
    public function __construct(Documentation $docs)
    {
        $this->docs = $docs;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return redirect('docs/'.DEFAULT_VERSION.'/'.DEFAULT_LANG . '/installation');
    }

        /**
     * Show a documentation page.
     *
     * @param  string $version
     * @param  string|null $page
     * @return Response
     */
    public function show($version, $lang, $page = null)
    {
        if (!$this->isVersion($version)) {
            return redirect('docs/'.DEFAULT_VERSION.'/'.$lang.'/'.$version, 301);
        }

        if (is_null($page)) {
            return redirect('docs/'.DEFAULT_VERSION.'/'.$lang.'/installation', 301);
        }

        if (! defined('CURRENT_VERSION')) {
            define('CURRENT_VERSION', $version);
        }

        if (! defined('CURRENT_LANG')) {
            define('CURRENT_LANG', $lang);
        }

        $currentLang = \App\Languaje::where('iso', $lang)->first();

        app()->setLocale( $currentLang->iso );

        $sectionPage = $page ? $page : 'installation';
        $content = $this->docs->get($version, $sectionPage, $lang);

        if (is_null($content)) {
            return response()->view('docs::index', [
                'title' => 'Page not found',
                'index' => $this->docs->getIndex($version, $lang),
                'content' => view('docs::partials.doc-missing'),
                'versions' => Documentation::getDocVersions(),
                'currentVersion' => $version,
                'currentSection' => '',
                'currentLang' => $currentLang
            ], 404);
        }

        $title = (new Crawler($content))->filterXPath('//h1');

        $section = '';
        if ($this->docs->sectionExists($version, $page, $lang)) {
            $section .= '/'.$lang.'/'.$page;
        } elseif (!is_null($page)) {
            //
            return redirect('/docs/'.$version.'/'.$lang);
        }

        return view('docs::index', [
            'title' => count($title) ? $title->text() : null,
            'index' => $this->docs->getIndex($version, $lang),
            'content' => $content,
            'versions' => Documentation::getDocVersions(),
            'currentVersion' => $version,
            'currentSection' => $section,
            'currentLang' => $currentLang
        ]);
    }

    /**
     * Determine if the given URL segment is a valid version.
     *
     * @param  string  $version
     * @return bool
     */
    protected function isVersion($version)
    {
        return array_key_exists($version, Documentation::getDocVersions());
    }

}
