<?php

namespace Mnabialek\LaravelMultiDomain;

use Illuminate\Log\Writer;
use Illuminate\Contracts\Foundation\Application as App;

class ConfigureLogging extends \Illuminate\Foundation\Bootstrap\ConfigureLogging
{
    /**
     * {@inheritdoc}
     */
    protected function configureSingleHandler(App $app, Writer $log)
    {
        $log->useFiles($this->getLogsPath($app) . 'laravel.log');
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDailyHandler(App $app, Writer $log)
    {
        $log->useDailyFiles(
            $this->getLogsPath($app) . 'laravel.log',
            $app->make('config')->get('app.log_max_files', 5)
        );
    }

    /**
     * Get logs path
     *
     * @param App $app
     * @return string
     */
    protected function getLogsPath(App $app)
    {
        /** @var MultiDomain $multiDomain */
        $multiDomain = $app->make(MultiDomain::class);

        return str_replace('{env}', $app->environment(),
            $multiDomain->get('paths.logs')) . DIRECTORY_SEPARATOR;
    }
}
