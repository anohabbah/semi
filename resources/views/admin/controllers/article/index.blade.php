@extends('admin.layouts.master')

@section('title', 'Liste de tous les articles')

@section('content')

    <div>
        <ul class="breadcrumb">
            <li>
                <a href="{{ url('/admin') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('articles.index') }}">Liste des Documents</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-star-empty"></i> Liste de tous les Documents enregistrés à ce jour.</h2>
                    <div class="box-icon">
                        <a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <table id="docs_table" data-url="{{ route('articles.ajaxendpoint') }}"
                           class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                        <thead>
                        <tr>
                            <th width="15%">Auteur</th>
                            <th width="65%">Thème</th>
                            <th width="10%">Filière</th>
                            <th width="10%">Publié le</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Auteur</th>
                            <th>Thème</th>
                            <th>Filière</th>
                            <th>Date de Publication</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div><!--/row-->

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('bower_components/datatable/media/css/jquery.dataTables.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('bower_components/datatable/media/js/jquery.dataTables.min.js') }}"></script>
<script>
    $().ready(function () {
        if ($('#docs_table').length) {
            $('#docs_table').dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": $('#docs_table').data('url'),
                    "type": "POST",
                    'headers': {
                        'X-CSRF-TOKEN': Mise.csrfToken
                    }
                },
                "columns": [
                    { "data": "name", "searchable": false },
                    { "data": "title" },
                    { "data": "study", "searchable": false },
                    { "data": "published_at" }
                ],
                "order": [[0,'desc']]
            });
        }
    });
</script>
@endpush
