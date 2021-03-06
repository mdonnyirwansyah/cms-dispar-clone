@extends('layouts.app')

@section('title', 'Edit News Post')

@push('javascript')
<script>
    ClassicEditor
    .create( document.querySelector( '#content' ), {
        toolbar: [ 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
    } )
    .catch( error => {
        console.log( error );
    } );
    ClassicEditor
    .create( document.querySelector( '#content_en' ), {
        toolbar: [ 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
    } )
    .catch( error => {
        console.log( error );
    } );
</script>
<script>
    function printErrorMsg (msg) {
        $.each( msg, function ( key, value ) {
            $('#'+key).addClass('is-invalid');
            $('#thumbnail-input').addClass('is-invalid');
            $('.'+key+'_err').text(value);
            $('#'+key).change(function () {
                $('#'+key).removeClass('is-invalid');
                $('#thumbnail-input').removeClass('is-invalid');
                $('#'+key).addClass('is-valid');
            } );
        });
    }

    $(document).ready( function() {
        $('.select2').select2({
            theme: 'bootstrap4',
            placeholder: 'Select tags',
        });
        $('.custom-file-input').change(function () {
            var fileName = $(this).val().split('\\').slice(-1)[0];
            $(this).next('.custom-file-label').html(fileName);
        })
        $('#form-action').submit(function (e) {
            e.preventDefault();
            $('#btn').attr('disabled', true);
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if(response.success){
                        toastr.success(response.success, 'Congratulations,');

                        async function redirect() {
                        let promise = new Promise(function(resolve, reject) {
                            setTimeout(function() { resolve('{{ route("news.posts.index") }}'); }, 3000);
                        });
                        window.location.href = await promise;
                        }

                        redirect();
                    }else{
                        printErrorMsg(response.error);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
                }
            });
        });
    });
</script>
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('news.posts.index') }}" class="btn btn-icon">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <h1>Edit News Post</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </div>
            <div class="breadcrumb-item">
                <a href="{{ route('news.posts.index') }}">News Posts</a>
            </div>
            <div class="breadcrumb-item">Edit News Post</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Edit Your Post</h2>
        <p class="section-lead">On this page you can edit a news post and fill in all fields.</p>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('news.posts.update', $newsPost) }}" id="form-action" enctype="multipart/form-data">
                            @method('PUT')
                            @include('app.news.posts.partials.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
