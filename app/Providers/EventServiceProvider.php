<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Models\Meeting;
use DB;
use Carbon\Carbon;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        view()->composer('*', function($view) {
            if (\Auth::check()) {
                $id = \Auth::user()->id;
                $meetings = Meeting::where('start_date', '>', Carbon::today())
                    ->whereIn('id', function ($query) use ($id) {
                        $query->select('meeting_id')
                            ->from('meeting_user')
                            ->where('user_id', $id);
                    })->get();
                $cuantas = $meetings->count();
                $view->with('meetingsCount', $cuantas);
            }
        });
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
