@extends('admin.manage.mbCharges.panel')

@section('main')
	<table class="table table-hover table-compact">
		<tr>
			<th>{{ trans('admin.manage.mbCharges.index.name') }}</th>
			<th>{{ trans('admin.manage.mbCharges.index.email') }}</th>
			<th>
				@include('admin.manage.actions.global', [
					'createUrl' => route('admin.manage.mb_charges.create'),
				])
			</th>
		</tr>
		@foreach($mbCharges as $mbCharge)
			<tr>
				<td>{{ $mbCharge->name }}</td>
				<td>{{ $mbCharge->email }}</td>
				<td>
					@include('admin.manage.actions.local', [
						'editUrl' => route('admin.manage.mb_charges.edit', [$mbCharge]),
						'deleteUrl' => route('admin.manage.mb_charges.destroy', [$mbCharge]),
					])
				</td>
			</tr>
		@endforeach
	</table>
@endsection
