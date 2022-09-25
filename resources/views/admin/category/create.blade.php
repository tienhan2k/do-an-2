@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            {{-- @if (session('message'))
                <h2 class="alert alert-success" >{{ session('message') }}</h2>
            @endif --}}
            <div class="card">
                <div class="card-header">

                    <h2>Add category

                        <a href="{{ route('category.index') }}" class="text-white btn btn-primary btn-sm float-end">Back</a>
                    </h2>

                </div>
                <div class="card-body">

                    @if ($errors->any())
                        <div>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control"/>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Slug</label>
                                <input type="text" name="slug" class="form-control"/>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="">Description</label>
                                <textarea name="description" class="form-control" rows="3"></textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Image</label>
                                <input type="file" name="image" class="form-control"/>
                            </div>


                            <div class="col-md-6 mb-3">
                                <label for="">Status</label><br>
                                <input type="checkbox" name="status" />
                            </div>

                            <div>
                                <h2>SEO tags</h2>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Meta title</label>
                                <input type="text" name="meta_title" class="form-control"/>
                            </div>


                            <div class="col-md-12 mb-3">
                                <label for="">Meta keyword</label>
                                <textarea name="meta_keyword" class="form-control" rows="3"></textarea>
                            </div>


                            <div class="col-md-12 mb-3">
                                <label for="">Meta description</label>
                                <textarea name="meta_description" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-primary float-end text-white">Lưu</button>
                            </div>
                        </div>


                    </form>
                </div>

            </div>

        </div>
    </div>
@endsection
