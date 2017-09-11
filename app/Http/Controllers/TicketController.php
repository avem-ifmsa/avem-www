<?php

namespace Avem\Http\Controllers;

use DB;
use Auth;
use Session;
use Carbon\Carbon;
use Avem\ActivityTicket;
use Avem\PerformedActivity;
use Illuminate\Http\Request;

class TicketController extends Controller
{
	public function input()
	{
		return view('main.ticket.input', [
			'user' => Auth::user(),
		]);
	}

	public function exchange(Request $request)
	{
		$user = $request->user();
		if (!$user->isActive) {
			abort(404);
		}

		$code = $request->input('code');
		$ticket = ActivityTicket::where('code', $code)->first();

		if (!$ticket) {
			Session::flash('exchange-error', '<strong>¡Ups!</strong> El código introducido no es válido.');
			return redirect()->route('ticket.exchange');
		}

		if ($ticket->isExpired) {
			$expiredFor = $ticket->expires_at->diffForHumans();
			Session::flash('exchange-error', '<strong>¡Ups!</strong> El ticket caducó hace '.$expiredFor.'.');
			return redirect()->route('ticket.exchange');
		}

		if ($ticket->isExchanged) {
			if ($ticket->performedActivity->user->id === $user->id) {
				Session::flash('exchange-error', '<strong>¡Ups!</strong> Parece que ya has canjeado este ticket.');
			} else {
				Session::flash('exchange-error', '<strong>¡Ups!</strong> Otro usuario ya ha canjeado '.
				                                 'este ticket. Si el ticket te pertenece, puedes enviar un correo a '.
				                                 '<a href="mailto:webmaster@avem.es">webmaster@avem.es</a>.');
			}
			return redirect()->route('ticket.exchange');
		}

		if ($user->performedActivities()->where('activity_id', $ticket->activity->id)->exists()) {
			Session::flash('exchange-error', '<strong>¡Ups!</strong> Parece que ya se te habían '.
			                                 'asignado los puntos para esta actividad.');
			return redirect()->route('ticket.exchange');
		}

		DB::transaction(function() use ($user, $ticket) {
			$performedActivity = new PerformedActivity;
			$performedActivity->user()->associate($user);
			$performedActivity->activity()->associate($ticket->activity);
			$performedActivity->witnessPeriod()->associate($ticket->issuerPeriod);
			$performedActivity->save();

			$ticket->performedActivity()->associate($performedActivity);
			$ticket->save();
		});

		Session::flash('exchange-success', '<strong>¡Genial!</strong> Su ticket se ha canjeado con éxito.');
		return redirect()->route('ticket.exchange');
	}
}
