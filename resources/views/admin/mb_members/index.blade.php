@extends('layouts.admin')

@section('content')
	<h1>Gestión de miembros de junta</h1>
	<div>
		<input type="search">
		<a href="{{ route('admin.mb_members.create') }}">
			<img src="{{ asset('img/actions-create.png') }}">
			<span>Crear nuevo miembro de junta</span>
		</a>
	</div>

	<div class="gallery">
		<ul class="gallery-items">
			@foreach($mbMembers as $mbMember)
				<li class="gallery-items">
					<img class="item-image" src="{{ $mbMember->user->imageUrl }}">
					<span class="item-text">{{ $mbMember->user->fullName }}</span>
					<ul class="item-actions">
						<li class="item-action">
							<a href="{{ route('admin.mb_members.edit', [$mbMember]) }}">
								<img src="{{ asset('img/action-edit.png') }}">
							</a>
						</li>

						<li class="item-action">
							@component('components.action', [
								'method' => 'delete',
								'url'    => route('admin.mb_members.destroy', [$mbMember]),
							])
								<img src="{{ asset('img/action-delete.png') }}">
							@endcomponent
						</li>
					</ul>
				</li>
			@endforeach
		</ul
	</div>
@stop
