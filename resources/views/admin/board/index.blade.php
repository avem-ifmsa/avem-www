@extends('layouts.admin')

@section('content')
	<h1 class="my-4">
		Junta directiva
	</h1>

	<div class="my-5 group-tree">
		<ol class="tree-groups">
			@foreach ($workingGroups->where('parent_id', null) as $topGroup)
				@include('admin.board._wgTreePartial', ['workingGroup' => $topGroup, 'level' => 0])
			@endforeach
		</ol>
	</div>
@stop
