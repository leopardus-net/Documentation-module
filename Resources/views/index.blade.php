@extends('docs::layouts.master')

@section('title')
	{{ $title }}
@stop

@section('content')

	<div class="row page-titles">
	    <div class="col-md-5 col-8 align-self-center">
	        <h3 class="text-themecolor m-b-0 m-t-0">{{ $title }}</h3>
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="javascript:void(0)">Documentación</a></li>
	            <li class="breadcrumb-item active">{{ $title }}</li>
	        </ol>
	    </div>
	</div>
	
 	<div class="card">
 		<div class="card-body">
 			<div class="docs language-php scotchified">
			    <article>
					{!! $content !!}
				</article>
			</div>
 		</div>
 	</div>
    
@stop

@section('scripts')

@stop
