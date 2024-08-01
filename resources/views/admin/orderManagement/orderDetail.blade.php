@extends('admin.master')

@section('title')
Order Detail
@endsection

@section('header')
<h4 class="fw-bold pt-3"><span class="text-muted fw-light">Admin / Order Management /</span> Order Detail Info</h4>
@endsection

@section('active_order1')
active open
@endsection

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12 offset-xl-1 offset-lg-1 offset-md-1">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Order Detail Info</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 text-black" for="basic-default-name">
                            Ordered ID :
                        </label>
                        <label class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                            {{ $data->id }}
                        </label>
                    </div>
                    <div class="row mb-3">
                        <label class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 text-black" for="basic-default-name">
                            Ordered User :
                        </label>
                        <label class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                            {{ $data->user->name }}
                        </label>
                    </div>
                    <div class="row mb-3">
                        <label class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 text-black" for="basic-default-name">
                            Email :
                        </label>
                        <label class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                            {{ $data->user->email }}
                        </label>
                    </div>
                    <div class="row mb-3">
                        <label class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 text-black" for="basic-default-name">
                            Phone number :
                        </label>
                        <label class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                            {{ $data->user->phone }}
                        </label>
                    </div>
                    <div class="row mb-3">
                        <label class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 text-black" for="basic-default-name">
                            Address :
                        </label>
                        <label class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                            {{ $data->user->address }}
                        </label>
                    </div>
                    <div class="row mb-3">
                        <label class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 text-black" for="basic-default-name">
                            Order created date :
                        </label>
                        <label class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                            {{ \Carbon\Carbon::parse($data->created_at)->format("l, F j, Y g:i A") }}
                        </label>
                    </div><br>
                    <hr><br>
                    <div class="row mb-3">
                        <label class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12 text-black"
                            for="basic-default-name">
                            <strong>Ordered Products</strong>
                        </label>
                    </div>
                    <div class="row mb-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><strong>Name</strong></th>
                                    <th><strong>Price</strong></th>
                                    <th><strong>Qty</strong></th>
                                    <th><strong>Total</strong></th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($data->orderProduct as $opitem)
                                <tr class="data-row">
                                    <td class="max-width-td"><strong>{{ $opitem->product->name }}</strong></td>
                                    <td class="max-width-td2"><strong>{{ $opitem->product->price }}</strong></td>
                                    <td class="max-width-td2"><strong>{{ $opitem->quantity }}</strong></td>
                                    <td class="max-width-td2">{{ ($opitem->product->price) * ($opitem->quantity) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <hr><br>
                    <div class="row mb-3">
                        <label class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12 text-black"
                            for="basic-default-name">
                            <strong>Total cost : {{ $data->total_cost }}</strong>
                        </label>
                    </div>

                    @if ($data->message)
                    <h3>Message</h3>
                    <p>{{ $data->message }}</p>
                    @endif

                    @if ($data->status == 'pending')
                    <form action="{{ route('admin#deny_order', $data->id) }}" method="post" class="deny-form" hidden>
                        @csrf
                        <textarea name="message" class="admin-message" cols="30" rows="10"></textarea>
                    </form>
                    <div class="row mt-5">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <form action="{{ route('admin#confirm_order', $data->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary">Confirm Order</button>
                            </form>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <button class="btn btn-danger deny-btn">Deny Order</button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- modal --}}
<div class="modal deny-modal">
    <div class="modal-content">
        <button class="crossX" style="background: none; border: none">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <p>Add your message here explaining the customer why you denied this order.</p>
        <br>
        <textarea class="admin-input-message" cols="30" rows="10" style="resize: none;">

        </textarea>
        <div class="modal-buttons">
            <button id="confirm-denial">Deny</button>
            <button id="cancel-denial">Cancel</button>
        </div>
    </div>
</div>

@endsection

@section('script_code')

<script>
    $(document).ready(function () {
        var denyModal = $('.deny-modal');
        var deleteCloseBtn = $('.crossX');
        var confirmBtn = $('#confirm-denial');
        var cancelBtn = $('#cancel-denial');

        // Show modal when logout button is clicked
        $('.deny-btn').on('click', function (event) {
            event.preventDefault();
            denyModal.show();
        });

        // Hide modal when 'x' is clicked
        deleteCloseBtn.on('click', function () {
            denyModal.hide();
        });

        // Hide modal when cancel button is clicked
        cancelBtn.on('click', function () {
            denyModal.hide();
        });

        // Submit the form when confirm button is clicked
        confirmBtn.on('click', function () {
            var inputMessage = $('.admin-input-message').val();
            $('.admin-message').val(inputMessage);
            $('.deny-form').submit();
        });

        // Hide modal if user clicks outside of the modal content
        $(window).on('click', function (event) {
            if ($(event.target).is(denyModal)) {
                denyModal.hide();
            }
        });
    });
</script>

@endsection