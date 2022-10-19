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

                    <h2>Add product

                        <a href="{{ route('product.index') }}" class="text-white btn btn-primary btn-sm float-end">Back</a>
                    </h2>

                </div>
                <div class="card-body">

                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf


                        <ul class="nav nav-tabs" id="myTab" role="tablist">

                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home-tab-pane" type="button" role="tab"
                                    aria-controls="home-tab-pane" aria-selected="true">Home</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="seotag-tab" data-bs-toggle="tab"
                                    data-bs-target="#seotag-tab-pane" type="button" role="tab"
                                    aria-controls="seotag-tab-pane" aria-selected="false">SEO
                                    Tags</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="detaits-tab" data-bs-toggle="tab"
                                    data-bs-target="#detaits-tab-pane" type="button" role="tab"
                                    aria-controls="detaits-tab-pane" aria-selected="false">Details</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="image-tab" data-bs-toggle="tab"
                                    data-bs-target="#image-tab-pane" type="button" role="tab"
                                    aria-controls="image-tab-pane" aria-selected="false">Product images</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="colors-tab" data-bs-toggle="tab"
                                    data-bs-target="#colors-tab-pane" type="button" role="tab"
                                    aria-controls="colors-tab-pane" aria-selected="false">Product colors</button>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade border p-3 show active" id="home-tab-pane" role="tabpanel"
                                aria-labelledby="home-tab" tabindex="0">

                                <div class="mb-3">
                                    <label>Category</label>
                                    <select name="category_id" class="form-control" id="">

                                        @forelse ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @empty
                                            <option value="">None</option>
                                        @endforelse

                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Product name</label>
                                    <input type="text" name="name" class="form-control" />

                                </div>

                                <div class="mb-3">
                                    <label>Product slug</label>
                                    <input type="text" name="slug" class="form-control" />

                                </div>

                                <div class="mb-3">
                                    <label>Select brand</label>
                                    <select name="brand" class="form-control" id="">

                                        @forelse ($brands as $brand)
                                            <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                                        @empty
                                            <option value="">None</option>
                                        @endforelse

                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" rows="4"></textarea>

                                </div>

                                <div class="mb-3">
                                    <label>Small description</label>
                                    <textarea name="small_description" class="form-control" rows="4"></textarea>

                                </div>

                            </div>
                            <div class="tab-pane fade border p-3" id="seotag-tab-pane" role="tabpanel" aria-labelledby="seotag-tab"
                                tabindex="0">

                                <div class="mb-3">
                                    <label>Meta title</label>
                                    <input type="text" name="meta_title" class="form-control" />

                                </div>

                                <div class="mb-3">
                                    <label>Meta description</label>
                                    <textarea type="text" name="meta_description" class="form-control" rows="4"></textarea>

                                </div>

                                <div class="mb-3">
                                    <label>Meta keyword</label>
                                    <textarea name="meta_keyword" class="form-control" rows="4"></textarea>

                                </div>

                            </div>

                            <div class="tab-pane fade border p-3" id="detaits-tab-pane" role="tabpanel"
                                aria-labelledby="detaits-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="md-3">
                                            <label>Original price</label>
                                            <input type="text" name="original_price" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="md-3">
                                            <label>Sale price</label>
                                            <input type="text" name="sale_price" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="md-3">
                                            <label>Quantity</label>
                                            <input type="number" name="quantity" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="md-3">
                                            <label>Trending</label>
                                            <input type="checkbox" name="trending" style="width: 20px; height: 20px" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="md-3">
                                            <label>Featured</label>
                                            <input type="checkbox" name="featured" style="width: 20px; height: 20px" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="md-3">
                                            <label>Status</label>
                                            <input type="checkbox" name="status" style="width: 20px; height: 20px" />
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="tab-pane fade border p-3" id="image-tab-pane" role="tabpanel"
                                aria-labelledby="image-tab" tabindex="0">
                                <div class="md-3">
                                    <label>Upload product images</label>
                                    <input type="file" name="image[]" multiple class="form-control" />
                                </div>
                            </div>

                            <div class="tab-pane fade border p-3" id="colors-tab-pane" role="tabpanel"
                                aria-labelledby="colors-tab" tabindex="0">
                                <div class="md-3">
                                    <label>Select colors</label>
                                    <div class="row">
                                        @forelse ($colors as $color_item)
                                            <div class="col-md-3">
                                                <div class="p-2 border">
                                                    Color: <input type="checkbox" name="colors[{{ $color_item->id }}]" value="{{ $color_item->id }}"/>{{ $color_item->name }}<br>
                                                    Quantity: <input type="number" name="color_quantity[{{ $color_item->id }}]" style="width: 70px; border: 1px solid"/>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-md-12">
                                                <h1>Không tìm thấy</h1>
                                            </div>
                                        @endforelse
                                    </div>

                                </div>
                            </div>

                        </div>


                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary float-end text-white">Lưu</button>
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>
@endsection
