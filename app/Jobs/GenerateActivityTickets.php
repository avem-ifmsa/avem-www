<?php

namespace Avem\Jobs;

use Log;
use Auth;
use Carbon\Carbon;
use Avem\Activity;
use Avem\ActivityTicket;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Avem\Events\GeneratedActivityTicketLot;

class GenerateActivityTickets implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	private $activity;
	private $chargePeriod;
	private $expiresAt;
	private $count;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct(Activity $activity, $count, $expiresAt)
	{
		$this->activity = $activity;
		$this->chargePeriod = Auth::user()->currentChargePeriod;
		$this->expiresAt = $expiresAt;
		$this->count = $count;
	}

	private function generateRandomCode($length = 6)
	{
		$code = [];
		$charset = 'abcdefghjkmnpqrstuvwxyz23456789';
		$charsetLength = strlen($charset);
		for ($i = 0; $i < $length; ++$i) {
			$index = mt_rand(0, $charsetLength - 1);
			$code[] = $charset[$index];
		}
		return implode('', $code);
	}
	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
		Log::info('Generating tickets for activity #'.$this->activity->id);

		$now = Carbon::now();
		$existingCodes = ActivityTicket::all()->pluck('code');

		for ($i = 0; $i < $this->count; ++$i) {
			do {
				$code = $this->generateRandomCode();
			} while ($existingCodes->contains('code', $code));
			$ticketCodes[] = $code;
		}

		ActivityTicket::insert(array_map(function($code) use ($now) {
			return [
				'code'             => $code,
				'created_at'       => $now,
				'expires_at'       => $this->expiresAt,
				'activity_id'      => $this->activity->id,
				'charge_period_id' => $this->chargePeriod->id,
			];
		}, $ticketCodes));

		$count = $this->count;
		$activity = $this->activity;
		$user = $this->chargePeriod->user;
		event(new GeneratedActivityTicketLot($user, $activity, $count));

		Log::info('Generated '.$this->count.' tickets');
	}
}
