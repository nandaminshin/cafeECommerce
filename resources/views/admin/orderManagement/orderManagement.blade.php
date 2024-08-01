@extends('admin.master')

@section('title')
Order Management
@endsection

@section('header')
<h4 class="fw-bold pt-3"><span class="text-muted fw-light">Admin /</span> Order Management</h4>
@endsection

@section('active_order1')
active open
@endsection

@section('content')

<div class="py-3">
    @livewire('alertMessage')
</div>


<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="card col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="d-flex">
                <h5 class="card-header">Order table</h5>
                <a href="{{ route('admin#confirmed_order_page') }}" class="card-header me-5">
                    <button type="button" class="btn btn-sm rounded-pill btn-outline-primary"><i
                            class="fa-solid fa-check"></i>&nbsp;&nbsp;&nbsp; Confirmed Orders</button>
                </a>
                <a href="{{ route('admin#denied_order_page') }}" class="card-header me-5">
                    <button type="button" class="btn btn-sm rounded-pill btn-outline-primary"><i
                            class="fa-solid fa-check"></i>&nbsp;&nbsp;&nbsp; Denied Orders</button>
                </a>
                <div class="mt-3 ms-5">
                    <form action="{{ route('admin#user_management_page') }}" method="get">
                        @csrf
                        <div class="d-flex">
                            <input type="text" name="key" class="form-control" width="160px"
                                placeholder="Search username..." value="{{ request('key') }}">
                            <button type="submit" style="background: none; border: none;"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive text-nowrap">
                @if (!count($orders) > 0)
                <div class="alert alert-primary" role="alert">There is no order here!</div>
                @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Ordered User</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($orders as $item)
                        <tr class="data-row">
                            <td class="max-width-td"><strong>{{ $item->id }}</strong></td>
                            <td class="max-width-td2"><strong>{{ $item->user->name }}</strong></td>
                            <td class="max-width-td2">{{ \Carbon\Carbon::parse($item->created_at)->format("l, F j, Y g:i
                                A") }}</td>
                            <td class="max-width-td">
                                @if ( $item->status == 'pending')
                                <span class="badge rounded-pill bg-warning">Pending</span>
                                @elseif($item->status == 'confirmed')
                                <span class="badge rounded-pill bg-success">Confirmed</span>
                                @else
                                <span class="badge rounded-pill bg-danger">Denied</span>
                                @endif
                            </td>
                            <td class="max-width-td">{{ $item->total_cost }}</td>
                            <td>
                                <form action="{{ route('admin#remove_order', $item->id) }}" method="post"
                                    class="order-remove-form" hidden>
                                    @csrf
                                </form>
                                <a href="{{ route('admin#order_detail', $item->id) }}">
                                    <button type="button" class="btn btn-sm rounded-pill btn-outline-primary">
                                        <i class="fa-solid fa-file-lines"></i>&nbsp; Details
                                    </button>
                                </a>
                                <button type="button"
                                    class="btn btn-sm rounded-pill btn-outline-primary order-remove-btn">
                                    <i class="fa-solid fa-trash"></i>&nbsp; Remove
                                </button>
                                {{-- modal --}}
                                <div class="modal order-remove-modal">
                                    <div class="modal-content">
                                        <button class="crossX" style="background: none; border: none">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                        <p>Are you sure you want to remove <br />
                                            this order? <br /> </p>
                                        <div class="modal-buttons">
                                            <button id="confirm-remove">Remove</button>
                                            <button id="cancel-remove">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
</div>
{{ $orders->links() }}

@endsection

@section('script_code')

<script>
    $(document).ready(function () {
        $('.data-row').each(function () {
            var row = $(this);
            var orderRemoveModal = row.find('.order-remove-modal');
            var deleteCloseBtn = orderRemoveModal.find('.crossX');
            var confirmBtn = orderRemoveModal.find('#confirm-remove');
            var cancelBtn = orderRemoveModal.find('#cancel-remove');
            var removeBtn = row.find('.order-remove-btn');
            var orderRemoveForm = row.find('.order-remove-form');

            // Show modal when logout button is clicked
            removeBtn.on('click', function (event) {
                event.preventDefault();
                orderRemoveModal.show();
            });

            // Hide modal when 'x' is clicked
            deleteCloseBtn.on('click', function () {
                orderRemoveModal.hide();
            });

            // Hide modal when cancel button is clicked
            cancelBtn.on('click', function () {
                orderRemoveModal.hide();
            });

            // Submit the form when confirm button is clicked
            confirmBtn.on('click', function () {
                orderRemoveForm.submit();
            });

            // Hide modal if user clicks outside of the modal content
            $(window).on('click', function (event) {
                if ($(event.target).is(orderRemoveModal)) {
                    orderRemoveModal.hide();
                }
            });
        })
    })
</script>

@endsection