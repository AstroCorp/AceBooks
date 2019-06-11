@extends('layouts.app', ['logo' => true])

@section('content')
<div class="row m-0 justify-content-center">
    <div class="mt-4 col-10 col-xl-8">
        <div class="card">
            <div class="card-header">{{trans("collections.edit")}}</div>
            <div class="card-body">
                <form class="row justify-content-center" method="POST" action="{{ route('collection.update', $collection->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @if(session('status'))
                        <div class="alert d-block alert-success col-8" role="alert">
                            <strong>{{ trans("collections.message_success1") }}</strong>
                        </div>
                    @endif

                    <div class="form-group col-10 p-0">
                        <input-file-with-image-preview text-input="{{ trans('collections.input_img') }}" type="library" />
                    </div>
                    <div class="alert d-block alert-info col-8" role="alert">
                        <strong>{{ trans("collections.image_info") }}</strong>
                    </div>
                    @if ($errors->has('image'))
                        <span class="col-10 alert d-block mt-1 alert-danger" role="alert">
                            <strong>{{ $errors->first('image') }}</strong>
                        </span>
                    @endif

                    <div class="form-group col-10 p-0">
                        <input type="text" id="name" name="name" placeholder="* {{ trans('collections.input_name') }}"
                        value="{{ old('name') ? old('name') : $collection->name }}"
                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" required>

                        @if ($errors->has('name'))
                        <span class="alert d-block mt-1 alert-danger" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group col-10 p-0">
                        <input type="text" id="description" name="description" placeholder="{{ trans('collections.input_description') }}"
                        value="{{ old('description') ? old('description') : $collection->description }}"
                        class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}">

                        @if ($errors->has('description'))
                        <span class="alert d-block mt-1 alert-danger" role="alert">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                        @endif
                    </div>

                    <input-add-book-to-collection books="{{ $books }}" collection-books="{{ $collectionBooks }}" select-book-text="{{ trans('collections.selectBookText') }}"></input-add-book-to-collection>
                    <div class="col-10 p-0">
                        @if ($errors->has('bookCollection'))
                        <span class="alert d-block mt-1 alert-danger" role="alert">
                            <strong>{{ $errors->first('bookCollection') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group col-12 m-0 p-0 text-center">
                        <button type="submit" class="form-btn">
                            {{trans("collections.edit")}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
