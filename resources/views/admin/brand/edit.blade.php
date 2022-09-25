@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            {{-- @if (session('message'))
                <h2 class="alert alert-success" >{{ session('message') }}</h2>
            @endif --}}
            <div class="card">
                <div class="card-header">

                    <h2>Edit brand

                        <a href="{{ route('brand.index') }}" class="text-white btn btn-primary btn-sm float-end">Back</a>
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

                    <form action="{{ route('brand.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">

                            <div class="mb-3">
                                <label>Select Category</label>
                                <select name="category_id" required class="form-control">
                                    
                                    <option value="{{$brand->category->id == $brand->category_id}}">
                                        {{ $brand->category->name }}
                                    </option>
                                    @foreach ($category as $categoryItem)
                                        <option value="{{ $categoryItem->id }}">
                                            {{ $categoryItem->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error("category_id") <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name" value="{{ $brand->name }}" class="form-control"/>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="">Slug</label>
                                <input type="text" name="slug" value="{{ $brand->slug }}" class="form-control"/>
                            </div>

                            <div class="mb-3">
                                <label for="">Status</label><br>
                                <input type="checkbox" {{ $brand->status == '1' ? 'checked' : '' }} name="status" />
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
