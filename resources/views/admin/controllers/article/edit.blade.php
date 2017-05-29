@extends('admin.layouts.master')

@section('title', 'Documents Scientifiques > Créer Nouveau')

@section('content')

    <div>
        <ul class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <li>
                <a href="#">Documents Scientifiques</a>
            </li>
            <li>Créer Nouveau</li>
        </ul>
    </div>

    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-edit"></i> Enregistrer un Nouveau Document</h2>

                    <div class="box-icon">
                        <a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <form id="docs" role="form" method="post" action="{{ route('articles.update', $article) }}" enctype="multipart/form-data" class="clearfix">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}

                        <div class="col-lg-6 clearfix">
                            <div class="form-group clearfix{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="control-label">Titre (Thème) du document <span>*</span></label>
                                <input type="text" name="title" class="form-control" id="title"
                                       value="{{ old('title', $article->title) }}" autofocus required/>

                                {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                            </div>

                            <div class="form-group clearfix{{ $errors->has('file') ? ' has-error' : '' }}">
                                <label for="file" class="control-label">Fichier (*.pdf) <span>*</span></label>
                                <input type="file" name="file" class="form-control" id="file"
                                    data-type="{{ get_class($article) }}" data-id="{{ $article->id }}" data-url="{{ route('attachments.upload') }}" />

                                {!! $errors->first('file', '<span class="help-block">:message</span>') !!}
                            </div>

                            <div class="form-group clearfix{{ $errors->has('niveau_id') ? ' has-error' : '' }}">
                                <label for="niveau_id" class="control-label">Fichier (*.pdf) <span>*</span></label>
                                <select name="niveau_id" class="form-control" id="niveau_id" required>
                                    <option value="">-- Sélectionnner un niveau --</option>
                                    <option value="1" {{ old('niveau_id', $article->niveau_id) == 1 ? 'selected' : '' }}>LICENCE</option>
                                    <option value="2" {{ old('niveau_id', $article->niveau_id) == 2 ? 'selected' : '' }}>MASTER</option>
                                    <option value="3" {{ old('niveau_id', $article->niveau_id) == 3 ? 'selected' : '' }}>DOCTORAT</option>
                                </select>

                                {!! $errors->first('niveau_id', '<span class="help-block">:message</span>') !!}
                            </div>

                            <div class="form-group clearfix{{ $errors->has('tags') ? ' has-error' : '' }}">
                                <label for="tags" class="control-label">Mots clés <span>*</span></label>
                                <input type="text" name="tags" class="form-control" id="tags"
                                       value="{{ old('tags', $article->tags) }}" required />
                                <span class="help-block">Terminer par une virgule (,)</span>

                                {!! $errors->first('tags', '<span class="help-block">:message</span>') !!}
                            </div>

                            <div class="form-group clearfix{{ $errors->has('authors') ? ' has-error' : '' }}">
                                <label for="author" class="control-label">Les Auteurs <span>*</span></label>
                                <input type="text" name="authors" class="form-control" id="author"
                                       value="{{ old('authors', $article->author) }}" required />
                                <span class="help-block">Terminer chaque Nom d'auteur par une virgule (,)</span>

                                {!! $errors->first('authors', '<span class="help-block">:message</span>') !!}
                            </div>

                            <div class="form-group clearfix{{ $errors->has('published_at') ? ' has-error' : '' }}">
                                <label for="published_at" class="control-label"> Date de Publication <span>*</span></label>
                                <input type="text" name="published_at" class="form-control" id="published_at"
                                       value="{{ old('published_at', $article->published_at ? $article->published_at->format('d/m/Y') : null) }}"/>

                                {!! $errors->first('authors', '<span class="help-block">:message</span>') !!}
                            </div>

                            <div class="form-group clearfix">
                                <label for="study" class="control-label">Filière</label>
                                <label class="radio-inline">
                                    <input type="radio" id="study_1" name="study" value="1" {{ old('study', $article->filiere_id) == 1 ? 'checked' : '' }}> SI
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" id="study_2" name="study" value="2" {{ old('study', $article->filiere_id) == 2 ? 'checked' : '' }}> SM
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" id="study_3" name="study" value="3" {{ old('study', $article->filiere_id) == 3 ? 'checked' : '' }}> SPI
                                </label>
                            </div>
                        </div>

                        <div class="col-lg-6">

                            <div class="form-group clearfix{{ $errors->has('body') ? ' has-error' : '' }}">
                                <label for="body" class="control-label">Resumé du document <span>*</span></label>
                                <textarea type="text" name="body" class="form-control"
                                          id="body">{{ old('body', $article->body) }}</textarea>

                                {!! $errors->first('body', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script src="{{ asset('vendor/jquery-ui-1.12.1/jquery-ui.min.js') }}"></script>
<script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-tokenfield/dist/bootstrap-tokenfield.min.js') }}"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
@endpush

@push('styles')
<link rel="stylesheet" href="{{ asset('vendor/jquery-ui-1.12.1/jquery-ui.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/bootstrap-tokenfield/dist/css/bootstrap-tokenfield.min.css') }}">
@endpush
