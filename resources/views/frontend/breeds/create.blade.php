@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.breed.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.breeds.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.breed.fields.type') }}</label>
                            <select class="form-control" name="type" id="type" required>
                                <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Breed::TYPE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.breed.fields.type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="breed">{{ trans('cruds.breed.fields.breed') }}</label>
                            <input class="form-control" type="text" name="breed" id="breed" value="{{ old('breed', '') }}" required>
                            @if($errors->has('breed'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('breed') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.breed.fields.breed_helper') }}</span>
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