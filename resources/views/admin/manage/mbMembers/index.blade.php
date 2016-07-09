@extends('admin.manage.mbMembers.panel')

@section('main')
	<table class="table table-hover table-compact">
		<thead>
			<tr>
				<th>{{ trans('admin.manage.mbMembers.index.member') }}</th>
				<th>{{ trans('admin.manage.mbMembers.index.dniNif') }}</th>
				<th>{{ trans('admin.manage.mbMembers.index.phone') }}</th>
				<th>{{ trans('admin.manage.mbMembers.index.isActive')}}</th>
				<th>
					@include('admin.manage.actions.global', [
						'createUrl' => route('admin.manage.mb_members.create'),
					])
				</th>
			</tr>
		</thead>

		<tbody>
		@foreach($mbMembers as $mbMember)
			<tr>
				<td>
					@if ($member = $mbMember->member)
						{{ $member->full_name }} ({{ $member->id}})
					@else
						{{ trans('admin.manage.mbMembers.index.notApplicable') }}
					@endif
				</td>
				<td>{{ $mbMember->dni_nif }}</td>
				<td>{{ $mbMember->phone }}</td>
				<td>
					{{ $mbMember->is_active
							? trans('admin.manage.mbMembers.index.yes')
							: trans('admin.manage.mbMembers.index.no') }}
				</td>
				<td>
					@include('admin.manage.actions.local', [
						'editUrl' => route('admin.manage.mb_members.edit', [$mbMember]),
						'deleteUrl' => route('admin.manage.mb_members.destroy', [$mbMember]),
					])
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@endsection
