@extends('layouts.app', ['logo' => true])

@section('content')
<div class="row m-0 justify-content-center">
    <div class="mt-4 col-10 col-xl-8">
        <div class="card">
            <div class="card-header">{{trans("books.create")}}</div>
            <div class="card-body">
                <form method="POST" action="{{ route('book.store') }}" enctype="multipart/form-data">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
