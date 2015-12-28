<?php

namespace Mnabialek\LaravelMultiDomain;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Arr;

class MultiDomain
{
    /**
     * @var Container
     */
    protected $app;

    /**
     * Module configuration settings
     *
     * @var array
     */
    protected $config = [];

    /**
     * Initialize class
     *
     * @param Container $app
     */
    public function __construct(Container $app)
    {
        $this->app = $app;
        $this->loadConfiguration();
    }

    /**
     * Get module configuration value
     *
     * @param string|null $key
     * @param mixed|null $default
     * @return mixed
     */
    public function get($key = null, $default = null)
    {
        return Arr::get($this->config, $key, $default);
    }

    /**
     * Get default configuration file path
     *
     * @return string
     */
    public function getDefaultConfigFilePath()
    {
        return __DIR__ . '../../config/multidomain.php';
    }

    /**
     * Get user configuration file path
     *
     * @return string
     */
    public function getConfigFilePath()
    {
        return config_path('multidomain.php');
    }

    /**
     * Load module configuration - if configuration is published we will use
     * user configuration file, otherwise we will use default module
     * configuration
     */
    protected function loadConfiguration()
    {
        // get user configuration file
        $userConfig = [];

        $path = $this->getConfigFilePath();

        if (file_exists($path)) {
            $userConfig = require $path;
        }

        $config = require $this->getDefaultConfigFilePath();

        $this->config = array_replace_recursive($config, $userConfig);
    }
}
