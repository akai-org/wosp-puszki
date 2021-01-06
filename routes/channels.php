<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

//Clients join this channel when they are counting boxes
Broadcast::channel('station-status.busy', function ($user) {
    return $user;
});

//Clients join this channel when they are ready to count
//on the liczymy.box.find view
Broadcast::channel('station-status.ready', function ($user) {
    return $user;
});
