<?php

namespace App\Listeners;

use App\Events\OrphanUpdatedEvent;
use App\Mail\ChangeOrphan;
use App\Models\OrphanUser;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

class OrphanUpdatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrphanUpdatedEvent  $event
     * @return void
     */
    public function handle(OrphanUpdatedEvent $event)
    {
        $orphan = $event->getOrphan();
        $data = $orphan->subscriptions()
            ->with('users')
            ->get();

        $data->each(function (OrphanUser $item) use ($orphan) {
            $item->users->each(function (User $user) use ($orphan) {
                Mail::send(new ChangeOrphan($orphan, $user));
            });
        });

        Artisan::call('name:convert');

    }
}
