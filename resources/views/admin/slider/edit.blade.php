@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Slider</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Slider</h4>

                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.slider.update', $slider->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Preview</label>
                                    <br>
                                    <img src="{{ asset($slider->banner) }}" width="200" alt="">
                                </div>
                                <div class="form-group">
                                    <label>Banner</label>
                                    <input name="banner" type="file" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Type</label>
                                    <input name="type" type="text" value="{{ $slider->type }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Title</label>
                                    <input name="title" type="text" value="{{ $slider->title }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Starting Price</label>
                                    <input name="starting_price" type="text"
                                        value="{{ $slider->starting_price }}"class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Button Url</label>
                                    <input name="btn_url" type="text" value="{{ $slider->btn_url }}"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Serial</label>
                                    <input name="serial" type="text" value="{{ $slider->serial }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option {{ $slider->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                        <option {{ $slider->status == 0 ? 'selected' : '' }} value="0">Inactive
                                        </option>
                                    </select>
                                </div>
                                <button class="btn btn-primary" type="submit">Update</button>

                            </form>
                        </div>

                    </div>
                </div>

            </div>


        </div>
    </section>
@endsection
