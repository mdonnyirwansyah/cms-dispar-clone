@extends('layouts.app')

@section('title', 'News Posts')

@push('stylesheet')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.25/r-2.2.9/datatables.min.css"/>
@endpush

@push('javascript')
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.25/r-2.2.9/datatables.min.js"></script>
  {!! $dataTable->scripts() !!}
  @include('app.news.posts.actions')
@endpush

@section('content')
<section class="section">
  <div class="section-header">
    <h1>News Posts</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active">
        <a href="{{ route('dashboard') }}">Dashboard</a>
      </div>
      <div class="breadcrumb-item">News Posts</div>
    </div>
  </div>
  <div class="section-body">
    <h2 class="section-title">List of News Posts</h2>
    <p class="section-lead">This page is for managing news posts.</p>
    <div class="card">
      <div class="card-body">
        <div class="col-12">
          <div class="section-header-button mb-3">
            @can('is-author')
            <a href="{{ route('news.posts.create') }}" class="btn btn-primary" onClick="createRecord()">Add New</a>
            @endcan
            <button class="btn btn-danger" id="btn-delete-checkbox" data-route="{{ route('news.posts.destroy.checked') }}" style="display: none"></button>
          </div>
          <hr>
          {!! $dataTable->table(['class' => 'table table-bordered table-striped dt-responsive nowrap', 'cellpadding' => '0', 'style' => 'width: 100%']) !!}
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
