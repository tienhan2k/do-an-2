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

                    <h2>Add Slider

                        <a href="{{ route('slider.index') }}" class="text-white btn btn-primary btn-sm float-end">Back</a>
                    </h2>

                </div>
                <div class="card-body">

                    <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="mb-3">
                                <label for="">Title</label>
                                <input type="text"  name="title" class="form-control"/>
                            </div>

                            <div class="mb-3">
                                <label for="">Description</label>
                                <textarea id="summernote" type="text" name="description" class="form-control" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="">Image</label>
                                <input type="file" name="image" class="form-control"/>
                            </div>

                            <div class="mb-3">
                                <label for="">Status</label><br>
                                <input type="checkbox" name="status" style="width: 30px; height: 30px"/>
                            </div>

                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-primary float-end text-white">Save</button>
                            </div>

                    </form>
                </div>

            </div>

        </div>
    </div>
@endsection

{{-- @section('scripts')
    <script>
        $('#summernote').summernote({
        tabsize: 2,
        height: 100
        });
    </script>
@endsection --}}
