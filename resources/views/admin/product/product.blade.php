@extends('admin.master')

@section('title')
All Products
@endsection

@section('header')
<h4 class="fw-bold pt-3"><span class="text-muted fw-light">Admin /</span> All Products</h4>
@endsection

@section('active_product1')
active open
@endsection

@section('active_product2')
active
@endsection

@section('content')

<div class="py-3">
    @livewire('alertMessage')
</div>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
        @if (count($category_data) == 0)
        <div class="alert alert-primary" role="alert">There is no product here!</div>

        @else

        @foreach ($category_data as $item)

        <div class="container">
            <a href="{{ route('admin#product_detail', $item->id) }}" class="category_card">
                <div class="col">
                    <div class="card h-100">
                        <img class="card-img-top card-image" @if ($item->image == null)
                        src="{{ asset('admin/assets/img/elements/18.jpg') }}"
                        @else
                        src="{{ asset('storage/'. $item->image) }}"
                        @endif
                        alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            <p class="card-text">
                                @if ($item->quantity > 0)
                                {{ $item->quantity }} items available.
                                @else
                                No item yet!
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        @endforeach

        @endif

    </div>
</div>

@endsection