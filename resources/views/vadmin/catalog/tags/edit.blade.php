@extends('layouts.vadmin.main')
@section('title', 'VADmin | Editar Etiqueta')

@section('styles')
@endsection

@section('header')
	@component('vadmin.components.header')
		@slot('breadcrums')
			<li class="breadcrumb-item"><a href="{{ url('vadmin')}}">Inicio</a></li>
			<li class="breadcrumb-item"><a href="{{ route('tags.index')}}">Etiquetas del Catálogo</a></li>
			<li class="breadcrumb-item active">Edición de Etiqueta</li>
		@endslot
		@slot('actions')
			<div class="list-actions">
				<h2>Editando etiqueta del Catálogo: " {{ $tag->name }} "</h2>
				{{-- Edit --}}
				<a href="#" id="EditBtn" class="btn btnGreen Hidden"><i class="icon-pencil2"></i> Editar</a>
			</div>
		@endslot
	@endcomponent
@endsection

@section('content')

	<div class="inner-wrapper">
		{!! Form::model($tag, [
				'method' => 'PATCH',
				'url' => ['vadmin/cat_tags', $tag->id],
				'files' => true,
				'class' => 'row big-form mw450', 
				'data-parsley-validate' => ''
			]) !!}
			@include('vadmin.catalog.tags.form')
			<div class="form-actions right">
				<a href="{{ route('cat_tags.index')}}">
					<button type="button" class="btn btnRed">
						<i class="icon-cross2"></i> Cancelar
					</button>
				</a>
				<button type="submit" class="btn btnGreen">
					<i class="icon-check2"></i> Guardar
				</button>
			</div>
		{!! Form::close() !!}
	</div>  
@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('plugins/validation/parsley.min.js') }}" ></script>
	<script type="text/javascript" src="{{ asset('plugins/validation/es/parsley-es.min.js') }}" ></script>
@endsection

@section('custom_js')
	<script>
		$('.CatalogLi').addClass('open');
		$('.CatalogTagsLi').addClass('open');
	</script>
@endsection
