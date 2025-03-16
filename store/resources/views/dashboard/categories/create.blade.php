@extends('layouts.dashboard')

@section('title', 'Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')
    <form action="{{ route('dashboard.categories.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Category Parent</label>
            <select name="parent_id" id="" class="form-select">
                <option value="">Primary Category</option>
                @foreach($parents as $parent)
                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="description">Category Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
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
                        checked>
                    <label class="form-check-label" >
                        active
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" value="archived">
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