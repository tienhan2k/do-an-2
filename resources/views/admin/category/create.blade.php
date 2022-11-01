@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
            <div class="card">
                <div class="card-header">

                    <h2>Add category

                        <a href="{{ route('category.index') }}" class="text-white btn btn-primary btn-sm float-end">Back</a>
                    </h2>

                </div>
                <div class="card-body">


                    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">Name</label>
                                <input type="text" value="{{ old('name') }}" name="name" class="form-control"/>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Slug</label>
                                <input type="text" value="{{ old('slug') }}" name="slug" class="form-control"/>
                            </div>

                            <div class="mb-3">
                                <label>Parent Category</label>
                                <select name="parent_category_id" class="form-control">
                                    <option value="">--Select Category--</option>
                                        @foreach ($categories as $categoryItem)
                                            <option value="{{ $categoryItem->id }}">
                                                {{ $categoryItem->name }}
                                            </option>
                                        @endforeach
                                </select>
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
                                <input type="text" value="{{ old('meta_title') }}" name="meta_title" class="form-control"/>
                            </div>


                            <div class="col-md-12 mb-3">
                                <label for="">Meta keyword</label>
                                <textarea name="meta_keyword" class="form-control" rows="3">{{ old('meta_keyword') }}</textarea>
                            </div>


                            <div class="col-md-12 mb-3">
                                <label for="">Meta description</label>
                                <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description') }}</textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-primary float-end text-white">Save</button>
                            </div>
                        </div>


                    </form>
                </div>

            </div>

        </div>
    </div>
@endsection
