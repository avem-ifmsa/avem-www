<?php

namespace Avem\Events;

use Log;
use Avem\User;
use Avem\Activity;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class GeneratedActivityTicketLot implements ShouldBroadcastNow
{
	use Dispatchable, InteractsWithSockets, SerializesModels;

	public $user;
	public $activity;
	public $count;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Activity $activity, $count)
	{
		$this->user = $user;
		$this->activity = $activity;
		$this->count = $count;
	}

	/**
	 * Get the channels the event should broadcast on.
	 *
	 * @return Channel|array
	 */
	public function broadcastOn()
	{
		return new PrivateChannel('Avem.User.'.$this->user->id);
	}
}
