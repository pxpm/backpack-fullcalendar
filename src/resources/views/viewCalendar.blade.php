@extends('backpack::layout')

@section('header')
	<section class="content-header">
	  <h1>
	    <span class="text-capitalize">{{ $crud->entity_name_plural }}</span>
	    <small>{{ trans('backpack::crud.all') }} <span class="text-lowercase">{{ $crud->entity_name_plural }}</span> {{ trans('backpack::crud.in_the_database') }}.</small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="{{ url(config('backpack.base.route_prefix'), 'dashboard') }}">{{ trans('backpack::crud.admin') }}</a></li>
	    <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
	    <li class="active">{{ trans('backpack::crud.list') }}</li>
	  </ol>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="row">

    <!-- THE ACTUAL CONTENT -->
    <div class="col-md-12">
      <div class="box">

        <div class="box-body">

            {!! $calEventsFront->calendar() !!}

        </div><!-- /.box-body -->



      </div><!-- /.box -->
    </div>

  </div>

@endsection

@section('after_styles')
  <!-- DATA TABLES -->

    <link href="{{ asset('vendor/pxpm/backpack-fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" type="text/css" />

  <!-- CRUD LIST CONTENT - crud_list_styles stack -->
  @stack('crud_list_styles')
@endsection

@section('after_scripts')
	<!-- DATA TABLES SCRIPT -->

    <script src="{{ asset('vendor/pxpm/backpack-fullcalendar/lib/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/pxpm/backpack-fullcalendar/lib/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/pxpm/backpack-fullcalendar/fullcalendar.min.js') }}" type="text/javascript"></script>



    {!! $calEventsFront->script() !!}
  <!-- CRUD LIST CONTENT - crud_list_scripts stack -->
    @stack('crud_list_scripts')
@endsection
