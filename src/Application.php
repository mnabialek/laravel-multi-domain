<?php

namespace Mnabialek\LaravelMultiDomain;

class Application extends \Illuminate\Foundation\Application
{
    /**
     * {@inheritdoc}
     */
    public function getCachedConfigPath()
    {
        return $this->getCustomPath('bootstrap_cache') . 'config.php';
    }

    /**
     * {@inheritdoc}
     */
    public function getCachedRoutesPath()
    {
        return $this->getCustomPath('bootstrap_cache') . 'routes.php';
    }

    /**
     * {@inheritdoc}
     */
    public function databasePath()
    {
        return $this->databasePath ?: $this->getCustomPath('database');
    }

    /**
     * {@inheritdoc}
     */
    public function langPath()
    {
        return $this->getCustomPath('lang');
    }

    /**
     * {@inheritdoc}
     */
    public function storagePath()
    {
        return $this->storagePath ?: $this->getCustomPath('storage');
    }

    /**
     * Get bootstrap cache directory
     *
     * @param string $name
     * @return string
     */
    protected function getCustomPath($name)
    {
        /** @var MultiDomain $multiDomain */
        $multiDomain = $this->make(MultiDomain::class);

        return str_replace(['{env}'], env('APP_ENV'),
            $multiDomain->get("paths.{$name}")) . DIRECTORY_SEPARATOR;
    }
}
