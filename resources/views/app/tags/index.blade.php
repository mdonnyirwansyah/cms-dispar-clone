@extends('layouts.app')

@section('title', 'Tags')

@push('stylesheet')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.25/r-2.2.9/datatables.min.css"/>
@endpush

@push('javascript')
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.25/r-2.2.9/datatables.min.js"></script>
  {!! $dataTable->scripts() !!}
  @include('app.tags.actions')
@endpush

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Tags</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active">
        <a href="{{ route('dashboard') }}">Dashboard</a>
      </div>
      <div class="breadcrumb-item">Tags</div>
    </div>
  </div>
  <div class="section-body">
    <h2 class="section-title">List of Tags</h2>
    <p class="section-lead">This page is for managing tags.</p>
    <div class="card">
      <div class="card-body">
        <div class="col-12">
          <div class="section-header-button mb-3">
            <button class="btn btn-primary" onClick="createRecord()">Add New</button>
            <button class="btn btn-danger" id="btn-delete-checkbox" data-route="{{ route('tags.destroy.checked') }}" style="display: none"></button>
          </div>
          <hr>
          {!! $dataTable->table(['class' => 'table table-bordered table-striped dt-responsive nowrap', 'cellpadding' => '0', 'style' => 'width: 100%']) !!}
        </div>
      </div>
    </div>
  </div>
</section>
<div id="view-modal" style="display: none"></div>
@endsection
