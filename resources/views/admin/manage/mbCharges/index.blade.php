@extends('admin.manage.mbCharges.panel')

@section('panel')
	<table class="table table-hover table-compact">
		<thead>
			<tr>
				<th>{{ trans('admin.manage.mbCharges.index.name') }}</th>
				<th>{{ trans('admin.manage.mbCharges.index.email') }}</th>
				<th>
					@include('admin.actions.manageGlobal', [
						'createUrl' => url('/admin/manage/mb-charges/create'),
					])
				</th>
			</tr>
		</thead>

		<tbody>
		@foreach($mbCharges as $mbCharge)
			<tr>
				<td>{{ $mbCharge->name }}</td>
				<td>{{ $mbCharge->email }}</td>
				<td>
					@include('admin.actions.manageLocal', [
						'editUrl' => route('admin.manage.mb-charges.edit', [$mbCharge]),
						'deleteUrl' => route('admin.manage.mb-charges.destroy', [$mbCharge]),
					])
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@endsection
