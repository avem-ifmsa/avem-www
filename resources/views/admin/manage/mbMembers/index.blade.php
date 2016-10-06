@extends('admin.manage.mbMembers.panel')

@section('panel')
	<table class="table table-hover table-compact">
		<thead>
			<tr>
				<th>{{ trans('admin.manage.mbMembers.index.id')       }}</th>
				<th>{{ trans('admin.manage.mbMembers.index.member')   }}</th>
				<th>{{ trans('admin.manage.mbMembers.index.dniNif')   }}</th>
				<th>{{ trans('admin.manage.mbMembers.index.phone')    }}</th>
				<th>{{ trans('admin.manage.mbMembers.index.isActive') }}</th>
				<th>
					@include('admin.manage._globalActions', [
						'createUrl' => url('/admin/manage/mb-members/create'),
					])
				</th>
			</tr>
		</thead>

		<tbody>
		@foreach($mbMembers as $mbMember)
			<tr>
				<td>{{ $mbMember->id }}</td>
				<td>
					{{ $mbMember->member
						? $mbMember->member->full_name
						: trans('admin.manage.mbMembers.index.notApplicable')
					}}
				</td>
				<td>{{ $mbMember->dni_nif }}</td>
				<td>{{ $mbMember->phone }}</td>
				<td>
					{{ $mbMember->is_active
							? trans('admin.manage.mbMembers.index.yes')
							: trans('admin.manage.mbMembers.index.no') }}
				</td>
				<td class="text-xs-center">
					@include('admin.manage._singleActions', [
						'editUrl' => route('admin.manage.mb-members.edit', [$mbMember]),
						'deleteUrl' => route('admin.manage.mb-members.destroy', [$mbMember]),
					])
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@endsection
