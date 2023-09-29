<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\AccountRepository;
use App\Repositories\Contracts\BlacklistsRepository;
use App\Repositories\Contracts\CampaignRepository;
use App\Repositories\Contracts\ContactsRepository;
use App\Repositories\Contracts\CountriesRepository;
use App\Repositories\Contracts\CurrencyRepository;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\KeywordRepository;
use App\Repositories\Contracts\LanguageRepository;
use App\Repositories\Contracts\PhoneNumberRepository;
use App\Repositories\Contracts\PlanRepository;
use App\Repositories\Contracts\RoleRepository;
use App\Repositories\Contracts\SenderIDRepository;
use App\Repositories\Contracts\SendingServerRepository;
use App\Repositories\Contracts\SettingsRepository;
use App\Repositories\Contracts\TemplatesRepository;
use App\Repositories\Contracts\SpamWordRepository;
use App\Repositories\Contracts\SubscriptionRepository;
use App\Repositories\Contracts\TemplateTagsRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Eloquent\EloquentAccountRepository;
use App\Repositories\Eloquent\EloquentBlacklistsRepository;
use App\Repositories\Eloquent\EloquentCampaignRepository;
use App\Repositories\Eloquent\EloquentContactsRepository;
use App\Repositories\Eloquent\EloquentCountriesRepository;
use App\Repositories\Eloquent\EloquentCurrencyRepository;
use App\Repositories\Eloquent\EloquentCustomerRepository;
use App\Repositories\Eloquent\EloquentKeywordRepository;
use App\Repositories\Eloquent\EloquentLanguageRepository;
use App\Repositories\Eloquent\EloquentPhoneNumberRepository;
use App\Repositories\Eloquent\EloquentPlanRepository;
use App\Repositories\Eloquent\EloquentRoleRepository;
use App\Repositories\Eloquent\EloquentSenderIDRepository;
use App\Repositories\Eloquent\EloquentSendingServerRepository;
use App\Repositories\Eloquent\EloquentSettingsRepository;
use App\Repositories\Eloquent\EloquentTemplatesRepository;
use App\Repositories\Eloquent\EloquentSpamWordRepository;
use App\Repositories\Eloquent\EloquentSubscriptionRepository;
use App\Repositories\Eloquent\EloquentTemplateTagsRepository;
use App\Repositories\Eloquent\EloquentUserRepository;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //

        $this->app->bind(
            UserRepository::class,
            EloquentUserRepository::class
        );

        $this->app->bind(
            AccountRepository::class,
            EloquentAccountRepository::class
        );

        $this->app->bind(
            RoleRepository::class,
            EloquentRoleRepository::class
        );

        $this->app->bind(
            CustomerRepository::class,
            EloquentCustomerRepository::class
        );

        $this->app->bind(
            CurrencyRepository::class,
            EloquentCurrencyRepository::class
        );

        $this->app->bind(
            SendingServerRepository::class,
            EloquentSendingServerRepository::class
        );

        $this->app->bind(
            PlanRepository::class,
            EloquentPlanRepository::class
        );

        $this->app->bind(
            KeywordRepository::class,
            EloquentKeywordRepository::class
        );

        $this->app->bind(
            SenderIDRepository::class,
            EloquentSenderIDRepository::class
        );

        $this->app->bind(
            SettingsRepository::class,
            EloquentSettingsRepository::class
        );

        $this->app->bind(
            LanguageRepository::class,
            EloquentLanguageRepository::class
        );

        $this->app->bind(
            SubscriptionRepository::class,
            EloquentSubscriptionRepository::class
        );

        $this->app->bind(
            PhoneNumberRepository::class,
            EloquentPhoneNumberRepository::class
        );

        $this->app->bind(
            TemplateTagsRepository::class,
            EloquentTemplateTagsRepository::class
        );

        $this->app->bind(
            BlacklistsRepository::class,
            EloquentBlacklistsRepository::class
        );

        $this->app->bind(
            SpamWordRepository::class,
            EloquentSpamWordRepository::class
        );

        $this->app->bind(
            ContactsRepository::class,
            EloquentContactsRepository::class
        );

        $this->app->bind(
            TemplatesRepository::class,
            EloquentTemplatesRepository::class
        );

        $this->app->bind(
            CampaignRepository::class,
            EloquentCampaignRepository::class
        );

        $this->app->bind(
            CountriesRepository::class,
            EloquentCountriesRepository::class
        );

        // if (env(key: 'APP_ENV') !=='local') {
            // URL::forceScheme(scheme:'https');
        //   }

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
