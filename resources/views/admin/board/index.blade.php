@extends('layouts.admin')

@section('content')
	<h1>
		<i class="mr-2 fa fa-sitemap"></i> Junta directiva
	</h1>

	<div class="mt-4 group-tree">
		<ol class="tree-groups">
			@foreach ($workingGroups->where('parent_id', null) as $topGroup)
				@include('admin.board._wgTreePartial', ['workingGroup' => $topGroup, 'level' => 0])
			@endforeach
		</ol>
	</div>
@stop
