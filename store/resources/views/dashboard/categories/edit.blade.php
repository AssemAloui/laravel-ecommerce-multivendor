@extends('layouts.dashboard')

@section('title', 'Edit Category')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
    <li class="breadcrumb-item active">Edit Category</li>
@endsection

@section('content')
    <form action="{{ route('dashboard.categories.update', $category->id) }}" method="post">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" name="name" id="name" value="{{ $category->name }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Category Parent</label>
            <select name="parent_id" id="" class="form-select">
                <option value="">Primary Category</option>
                @foreach($parents as $parent)
                    <option value="{{ $parent->id }}" @selected($category->parent_id == $parent->id)>{{ $parent->name }}</option>

                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="description">Category Description</label>
            <textarea name="description" id="description" class="form-control">{{ $category->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Status</label>
            <div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" value="active"
                         @checked($category->status == 'active')>
                    <label class="form-check-label" >
                        active
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" value="archived" @checked($category->status == 'archived')>
                    <label class="form-check-label" >
                        archived
                    </label>
                </div>

            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection