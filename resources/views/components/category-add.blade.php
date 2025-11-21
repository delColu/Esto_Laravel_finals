@extends('layouts.app')

@section('content')
<div class="container mt-4">


    <div class="card">
        <div class="card-header" style="background-color: #2a2a2aff; color: white;">
            <h1 class="h5 mb-0">Category Add</h1>
        </div>

        <div class="card-body" style="background-color: #171717ff; color: white;">
            <form action="{{ isset($category) ? route('categories.update', $category) : route('categories.store') }}"
            method="POST">

            @csrf

            @if(isset($category))
                @method('PUT')
            @endif



                <div class="mb-3">
                    <label for="catname" class="form-label">Name</label>
                    <input type="text" class="form-control" name="catname" id="catname"
                        value="{{ isset($category) ? $category->name : '' }}"
                        placeholder="Insert category name">
                </div>

                <div class="mb-3">
                    <label for="catdesc" class="form-label">Description</label>
                    <input type="text" class="form-control" name="catdesc" id="catdesc"
                        value="{{ isset($category) ? $category->description : '' }}"
                        placeholder="Insert category description">
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                    {{ isset($category) ? 'Update Category' : 'Save Category' }}
                    </button>
                    <button type="button" class="btn btn-danger" onclick="window.location='{{ route('home') }}'">
                        Cancel
                    </button>

                </div>
            </form>
            <div class="card mt-4">
                <div class="card-header" style="background-color: #2a2a2aff; color: white;">
                    <h1 class="h5 mb-0">Existing Categories</h1>
                </div>

                <div class="card-body" style="background-color: #171717ff; color: white;">
                    @if($categories->count() > 0)
                        <table class="table table-dark table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th style="width: 150px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>
                                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning">
                                            Edit
                                        </a>


                                        <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this category?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No categories found.</p>
                    @endif
                </div>
                <script>
                    document.addEventListener("DOMContentLoaded", () => {

                        const fields = document.querySelectorAll("input, select, textarea");

                        fields.forEach(field => {
                            // Restore value from localStorage
                            const saved = localStorage.getItem(field.name);
                            if (saved !== null) {
                                field.value = saved;
                            }

                            // Save to localStorage on change/typing
                            field.addEventListener("input", () => {
                                localStorage.setItem(field.name, field.value);
                            });
                        });
                    });
                </script>
                    @if(session('clear_form'))
                        <script>
                            localStorage.clear();
                        </script>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
