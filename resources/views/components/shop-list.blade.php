@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Shop List</h1>

    <div class="row">
        @forelse ($shops as $shop)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100" style="background-color: #171717ff; color: white;">
                    <div class="card-body">

                        <h5 class="card-title">{{ $shop->shopname }}</h5>

                        <p class="card-text mb-1">
                            <strong>Owner:</strong>
                            {{ $shop->Owner_fname }} {{ $shop->Owner_lname }}
                        </p>

                        <p class="card-text mb-1">
                            <strong>Category:</strong>
                            {{ $shop->category->name ?? 'No Category' }}
                        </p>
                            <br>
                        <p class="card-text">
                            <strong>Description:</strong><br>
                            {{ $shop->category->description ?? 'No Description' }}
                        </p>

                    </div>
                </div>
            </div>
        @empty
            <p>No shops found.</p>
        @endforelse
    </div>
</div>
@endsection
