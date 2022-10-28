@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            {{-- @if (session('message'))
                <h2 class="alert alert-success" >{{ session('message') }}</h2>
            @endif --}}
            <div class="card">
                <div class="card-header">

                    <h2>Edit slider

                        <a href="{{ route('slider.index') }}" class="text-white btn btn-primary btn-sm float-end">Back</a>
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

                    <form action="{{ route('slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                            <div class=" mb-3">
                                <label for="">Title</label>
                                <input type="text" name="title" value="{{ $slider->title }}" class="form-control"/>
                            </div>

                            <div class=" mb-3">
                                <label for="">Description</label>
                                <textarea type="text" name="description"  class="form-control" rows="3">{{ $slider->description }}</textarea>
                            </div>

                            <div class=" mb-3">
                                <label for="">Image</label>
                                <input type="file" name="image" class="form-control"/>
                                <img src="{{ asset('uploads/sliders') . '/' . $slider->image }}"
                                        style="width: 50px; height: 50px;" />
                            </div>

                            <div class=" mb-3">
                                <label for="">Status</label><br>
                                <input type="checkbox" {{ $slider->status == '1' ? 'checked' : '' }} name="status" style="width: 20px; height: 20px"/>
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
