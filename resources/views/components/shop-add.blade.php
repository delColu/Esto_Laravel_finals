@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="card">
        <div class="card-header" style="background-color: #2a2a2aff; color: white;">
            <h1 class="h5 mb-0">
                {{ isset($shop) ? 'Edit Shop' : 'Add Shop' }}
            </h1>
        </div>

        <div class="card-body" style="background-color: #171717ff; color: white;">

            {{-- FORM --}}
            <form action="{{ isset($shop) ? route('shops.update', $shop) : route('shops.store') }}"
                  method="POST">

                @csrf
                @if(isset($shop))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="Owner_fname" class="form-label">Owner First Name</label>
                    <input type="text" class="form-control" name="Owner_fname" id="Owner_fname"
                           value="{{ old('Owner_fname', $shop->Owner_fname ?? '') }}"
                           placeholder="Enter owner's first name">
                </div>

                <div class="mb-3">
                    <label for="Owner_lname" class="form-label">Owner Last Name</label>
                    <input type="text" class="form-control" name="Owner_lname" id="Owner_lname"
                           value="{{ old('Owner_lname', $shop->Owner_lname ?? '') }}"
                           placeholder="Enter owner's last name">
                </div>

                <div class="mb-3">
                    <label for="ShopName" class="form-label">Shop Name</label>
                    <input type="text" class="form-control" name="shopname" id="shopname"
                           value="{{ old('shopname', $shop->shopname ?? '') }}"
                           placeholder="Enter shop name">
                </div>

                <div class="mb-3">
                    <label for="catID" class="form-label">Category</label>
                    <select name="catID" id="catID" class="form-control">
                        <option value="">-- Select Category --</option>

                        @foreach($categories as $category)
                            <option value="{{ $category->catID }}"
                                {{ (string) old('catID', $shop->catID ?? '') === (string) $category->catID ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="SubCatID" class="form-label">Sub Category</label>

                    <select name="SubCatID" id="SubCatID" class="form-control">
                        <option value="">-- Select Subcategory --</option>

                        @foreach($subcategories as $sub)
                            <option value="{{ $sub->SubCatID }}"
                                {{ old('SubCatID', $shop->SubCatID ?? '') == $sub->SubCatID ? 'selected' : '' }}>
                                {{ $sub->name }}
                            </option>
                        @endforeach
                    </select>

                </div>





                {{-- BUTTONS --}}
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        {{ isset($shop) ? 'Update Shop' : 'Save Shop' }}
                    </button>

                    <button type="button" class="btn btn-danger"
                            onclick="window.location='{{ route('home') }}'">
                        Cancel
                    </button>
                </div>

            </form>

            {{-- SHOP LIST --}}
            <div class="card mt-4">
                <div class="card-header" style="background-color: #2a2a2aff; color: white;">
                    <h1 class="h5 mb-0">Existing Shops</h1>
                </div>

                <div class="card-body" style="background-color: #171717ff; color: white;">

                    @if($shops->count() > 0)
                        <table class="table table-dark table-striped">
                            <thead>
                                <tr>
                                    <th>Owner</th>
                                    <th>Shop Name</th>
                                    <th>Item Category</th>
                                    <th>Category ID</th>
                                    <th style="width: 150px;">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($shops as $s)


                                    <tr>
                                        <td>{{ $s->Owner_fname }} {{ $s->Owner_lname }}</td>
                                        <td>{{ $s->shopname }}</td>
                                        <td>{{ $s->Item_category }}</td>
                                        <td>{{ $s->catID }}</td>

                                        <td>
                                            <a href="{{ route('shops.edit', $s->ShopId) }}" class="btn btn-sm btn-warning">Edit</a>


                                            <form action="{{ route('shops.destroy', $s) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this shop?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach

                            </tbody>
                        </table>

                    @else
                        <p>No shops found.</p>
                    @endif

                </div>
                <script>
                    document.getElementById('catID').addEventListener('change', function () {
                        let catID = this.value;

                        let subSelect = document.getElementById('SubCatID');
                        subSelect.innerHTML = '<option value="">-- Select Subcategory --</option>';

                        if (catID) {
                            fetch('/subcategories/by-category/' + catID)
                                .then(res => res.json())
                                .then(data => {
                                    data.forEach(sub => {
                                        let opt = document.createElement('option');
                                        opt.value = sub.SubCatID;
                                        opt.textContent = sub.name;
                                        subSelect.appendChild(opt);
                                    });
                                });
                        }
                    });

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



