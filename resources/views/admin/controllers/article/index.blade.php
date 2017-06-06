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
                    <table id="docs" data-url="{{ route('articles.ajaxendpoint') }}"
                           class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                        <thead>
                        <tr>
                            <th width="15%">Auteur</th>
                            <th width="53%">Thème</th>
                            <th width="8%">Filière</th>
                            <th width="8%">Niveau</th>
                            <th width="8%">Publié le</th>
                            <th width="8%">Actions</th>
                        </tr>
                        </thead>
                        @forelse($articles as $article)
                            <tr>
                                <td>{{ $article->auteurs->implode('name', '; ') }}</td>
                                <td>{{ $article->title }}</td>
                                <td>{{ $article->filiere->name }}</td>
                                <td>{{ $article->niveau->name }}</td>
                                <td>{{ $article->published_at->format('d M Y') }}</td>
                                <td class="text-right">
                                    <div class="btn-group btn-group-xs" >
                                        <a href="{{ route('articles.edit', $article) }}" class="btn btn-default" data-toggle="tooltip" data-placement="top" type="button" title="Modifier"><i class="glyphicon glyphicon-edit"></i></a >
                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropmenu_{{ $article->id }}" data-toggle="dropdown">
                                            <i class="caret"></i>
                                        </button>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropmenu_{{ $article->id }}">
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#" onclick="event.preventDefault();document.getElementById('delete_form_{{ $article->id }}').submit()"><i class="glyphicon glyphicon-trash"></i> Supprimer</a></li>
                                        </ul>
                                        <form action="{{ route('articles.edit', $article) }}" id="delete_form_{{ $article->id }}" method="post" style="display: none;">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                        </form>
                                    </div >
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6">No data in the table</td></tr>
                        @endforelse
                        <tfoot>
                        <tr>
                            <th>Auteur</th>
                            <th>Thème</th>
                            <th>Filière</th>
                            <th>Niveau</th>
                            <th>Publié le</th>
                            <th>Actions</th>
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
                    { "data": "published_at" },
                    { "data": "actions", "searchable": false, "orderable": false }
                ],
                "order": [[0,'desc']]
            });
        }
    });
</script>
@endpush
