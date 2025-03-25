@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endif



<div class="form-group">
    <x-form.input label="Product Name" class="form-control-lg" role="input" name="name" :value="$product->name" />
</div>
<div class="form-group">
    <label for="">Category</label>
    <select name="category_id" class="form-control form-select">
        <option value="">Primary Category</option>
        @foreach(App\Models\Category::all() as $category)
            <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>
                {{ $category->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="">Description</label>
    <x-form.textarea name="description" :value="$product->description" />
</div>
<div class="form-group">
    <x-form.label for="image">Image</x-form.label>
    <x-form.input type="file" name="image" accept="image/*" />
    @if ($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" alt="" height="60">
    @endif
</div>
<div class="form-group">
    <x-form.input label="Price" name="price" :value="$product->price" />
</div>
<div class="form-group">
    <x-form.input label="Compare Price" name="compare_price" :value="$product->compare_price" />
</div>
<div class="form-group">
    <x-form.input label="Tags" name="tags" id="tags-input" :value="$tags" />
    {{-- <x-form.input label="Tags" name="tags" :value="$tags" /> --}}
</div>
<div class="form-group">
    <label for="">Status</label>
    <div>
        <x-form.radio name="status" :checked="$product->status" :options="['active' => 'Active', 'inactive' => 'Inactive', 'archived' => 'Archived']" />
    </div>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>
</div>



{{-- 
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.querySelector('input[name="tags"]');
        if (input) new Tagify(input);
    });
</script>
@endpush --}}