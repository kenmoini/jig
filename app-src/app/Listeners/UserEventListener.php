<?php

namespace App\Listeners;

use App\Activity;
use Illuminate\Http\Request;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
      $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
    }

    /**
     * Handle user login events.
     */
    public function handleUserLogin($event) {
      //Log user login
      $activity = new Activity;
      $activity->activity_type = 'login';
      $activity->actor_id = $event->user->id;
      $activity->actor_type = 'user';
      $activity->activity_data = '';
      $activity->user_agent = $this->request->header('User-Agent');
      $activity->actor_ip = $this->request->ip();
      $activity->save();
    }

    /**
     * Handle user logout events.
     */
    public function handleUserLogout($event) {}
    
    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\UserEventListener@handleUserLogin'
        );

        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'App\Listeners\UserEventListener@handleUserLogout'
        );
    }
}
