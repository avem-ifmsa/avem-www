@extends('admin.manage.mbMembers.panel')

@section('main')
	<table class="table table-hover table-compact">
		<tr>
			<th>{{ trans('admin.manage.mbMembers.index.member') }}</th>
			<th>{{ trans('admin.manage.mbMembers.index.dniNif') }}</th>
			<th>{{ trans('admin.manage.mbMembers.index.phone') }}</th>
			<th>
				@include('admin.manage.actions.global', [
					'createUrl' => route('admin.manage.mb_members.create'),
				])
			</th>
		</tr>

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
					@include('admin.manage.actions.local', [
						'editUrl' => route('admin.manage.mb_members.edit', [$mbMember]),
						'deleteUrl' => route('admin.manage.mb_members.destroy', [$mbMember]),
					])
				</td>
			</tr>
		@endforeach
	</table>
@endsection
