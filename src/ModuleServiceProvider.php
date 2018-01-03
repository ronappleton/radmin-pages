<?php

namespace RonAppleton\Radmin\Pages;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use RonAppleton\MenuBuilder\Traits\AddsMenu;

class ModuleServiceProvider extends ServiceProvider
{
    use AddsMenu;
    /**
     * The application instance.
     *
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'RonAppleton\Radmin\Pages\Http\Controllers';


    /**
     * Create a new service provider instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application $app
     * @return void
     */
    public function __construct($app)
    {
        parent::__construct($app);
        $this->app = $app;
    }

    public function boot(Dispatcher $events)
    {
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadViews();
        $this->menuListener($events);
    }

    public function register()
    {
    }

    private function packagePath($path)
    {
        return __DIR__ . "/../$path";
    }

    protected function loadViewsFrom($path, $namespace)
    {
        if (is_array($this->app->config['view']['paths'])) {
            foreach ($this->app->config['view']['paths'] as $viewPath) {
                if (is_dir($appPath = $viewPath . '/vendor/' . $namespace)) {
                    $this->app['view']->addNamespace($namespace, $appPath);
                }
            }
        }

        $this->app['view']->addNamespace($namespace, $path);
    }

    private function loadViews()
    {
        $viewPath = __DIR__ . '/../resources/views';

        $this->loadViewsFrom($viewPath, 'radmin-pages');

        $this->publishes([
            $viewPath => base_path('resources/views/vendor/radmin-pages'),
        ], 'views');
    }

    public function menusidebar()
    {
        return [
            [
                'text' => 'Content',
                'url' => '#',
                'icon' => 'users',
                'priority' => 'medium',
                'submenu' => [
                    [
                        'text' => 'Pages',
                        'url' => 'admin/page/index',
                        'icon' => 'user',
                        'priority' => 'medium',
                        'dropped',
                    ],
                    [
                        'text' => 'Page Categories',
                        'url' => 'admin/users',
                        'icon' => 'user',
                        'priority' => 'medium',
                        'dropped',
                    ],
                ],
            ],
        ];
    }
}