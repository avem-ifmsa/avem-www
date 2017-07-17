@if (!$workingGroup->subgroups->isEmpty())
	<optgroup label="{{ $workingGroup->name }}">
		@foreach($workingGroup->subgroups as $childGroup)
			@include('admin.charges._wgSelectPartial', [
				'workingGroup' => $childGroup,
			])
		@endforeach
	</optgroup>
@else
	<option value="{{ $workingGroup->id }}" {{
		$value == $workingGroup->id ? 'selected' : ''
	}}>{{ $workingGroup->name }}</option>
@endif