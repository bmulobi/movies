@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 mx-auto categories">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Mulobi Movies Categories</h4>
                        <div class="row">
                            <div class="col-md-10">You can create a new category here <i class="fa fa-hand-o-right"></i></div>
                            <div class="col-md-2">
                                <button type="button" data-toggle="modal" data-target="#addCategoryModal" class="btn btn-primary">
                                    <i class="fa fa-plus-circle"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 mx-auto">
                @if (session('errors'))
                    @foreach(session('errors') as $error)
                        @foreach($error as $message)
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @endforeach
                    @endforeach
                @endif
            </div>>
        </div>
        <div class="row">
            <div class="col-md-8 mx-auto categories">
                @foreach($categories as $category)
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ $category->name }}</h4>
                            <div class="row">
                                <div class="col-md-10">{{ $category->description }}</div>
                                <div class="col-md-2" id={{ $category->id }}>
                                    <button class="btn btn-primary">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    <button class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- new category Modal -->
    <div class="modal" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('storeCategory') }}" method="post" id="new-category-form">
                        @csrf
                        <div class="form-group">
                            <label for="category-name">Category Name</label>
                            <input class="form-control" id="category-name" name="name" placeholder="e.g comedy" type="text">
                        </div>
                        <div class="form-group">
                            <label for="category-description">Description</label>
                            <textarea name="description" id="category-description" cols="30" rows="5" class="form-control" placeholder="e.g really funny">
                            </textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="'save-category" form="new-category-form">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
