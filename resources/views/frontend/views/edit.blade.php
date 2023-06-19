@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.view.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.views.update", [$view->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="user_id">{{ trans('cruds.view.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id" required>
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $view->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.view.fields.user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="post_id">{{ trans('cruds.view.fields.post') }}</label>
                            <select class="form-control select2" name="post_id" id="post_id" required>
                                @foreach($posts as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('post_id') ? old('post_id') : $view->post->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('post'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('post') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.view.fields.post_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection