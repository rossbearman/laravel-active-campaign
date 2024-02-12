<?php

namespace RossBearman\ActiveCampaign;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use RossBearman\ActiveCampaign\Exceptions\InvalidConfigException;

class ActiveCampaignServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->singleton(ActiveCampaign::class, function () {
            $config = $this->resolveConfig();

            return new ActiveCampaign(
                $config['base_url'],
                $config['api_key'],
                $config['timeout'],
                $config['retry_times'],
                $config['retry_sleep'],
            );
        });
    }

    public function boot(): void
    {
        $configPath = __DIR__.'/../config/active-campaign.php';
        $this->publishes([$configPath => $this->getConfigPath()], 'config');
    }

    /**
     * Defer provision of ActiveCampaign service until needed
     *
     * @return array<int, class-string>
     */
    public function provides(): array
    {
        return [ActiveCampaign::class];
    }

    protected function getConfigPath(): string
    {
        return config_path('active-campaign.php');
    }

    /**
     * @return array{'base_url': string, 'api_key': string, 'timeout': int, 'retry_times': int|null, 'retry_sleep': int|null}
     *
     * @throws InvalidConfigException
     */
    protected function resolveConfig(): array
    {
        $config = [];

        $config['base_url'] = config('active-campaign.base_url');
        $config['api_key'] = config('active-campaign.api_key');
        $config['timeout'] = config('active-campaign.timeout');
        $config['retry_times'] = config('active-campaign.retry_times');
        $config['retry_sleep'] = config('active-campaign.retry_sleep');

        if (! is_string($config['base_url'])) {
            throw new InvalidConfigException('active-campaign.base_url must be a string');
        }

        if (! is_string($config['api_key'])) {
            throw new InvalidConfigException('active-campaign.api_key must be a string');
        }

        if (! is_int($config['timeout'])) {
            throw new InvalidConfigException('active-campaign.timeout must be an integer');
        }

        if ($config['retry_times'] !== null && ! is_int($config['retry_times'])) {
            throw new InvalidConfigException('active-campaign.retry_times must be an integer or null');
        }

        if ($config['retry_sleep'] !== null && ! is_int($config['retry_sleep'])) {
            throw new InvalidConfigException('active-campaign.retry_sleep must be an integer or null');
        }

        return $config;
    }
}
