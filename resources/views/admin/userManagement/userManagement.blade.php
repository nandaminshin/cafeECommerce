@extends('admin.master')

@section('title')
Admin Management
@endsection

@section('header')
<h4 class="fw-bold pt-3"><span class="text-muted fw-light">Admin /</span> User Management</h4>
@endsection

@section('active_user1')
active open
@endsection

@section('active_user3')
active
@endsection

@section('content')

<div class="py-3">
    @livewire('alertMessage')
</div>


<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="card col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="d-flex">
                <h5 class="card-header">User table</h5>
                <a href="{{ route('admin#add_new_admin') }}" class="card-header me-5">
                    <button type="button" class="btn btn-sm rounded-pill btn-outline-primary"><i
                            class="fa-solid fa-user-plus"></i>&nbsp;&nbsp;&nbsp; Add Admin</button>
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
                @if (count($data) == 0)
                <div class="alert alert-primary" role="alert">There is no user here!</div>
                @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($data as $item)
                        <tr class="data-row">
                            <td>
                                @if ($item->image == null)
                                <img src="{{ asset('admin/assets/img/elements/18.jpg') }}" alt="" width="50" height="50"
                                    style="border-radius: 50%">
                                @else
                                <img src="{{ asset('storage/' . $item->image) }}" alt="" width="50" height="50"
                                    style="border-radius: 50%">
                                @endif

                            </td>
                            <td class="max-width-td"><strong>{{ $item->name }}</strong></td>
                            <td class="max-width-td">{{ $item->email }}</td>
                            <td class="max-width-td">{{ $item->phone }}</td>
                            <td class="max-width-td">{{ $item->address }}</td>
                            <td>
                                <form
                                    action="{{ route('admin#remove_admin', ['id' => $item->id, 'current_admin_id' => Auth::user()->id ]) }}"
                                    method="post" class="admin-remove-form" hidden>
                                    @csrf
                                    <input type="password" class="admin-password" name="password" value="0">
                                </form>
                                <a href="{{ route('admin#user_detail', $item->id) }}">
                                    <button type="button" class="btn btn-sm rounded-pill btn-outline-primary">
                                        <i class="fa-solid fa-file-lines"></i>&nbsp; Details
                                    </button>
                                </a>
                                <button type="button"
                                    class="btn btn-sm rounded-pill btn-outline-primary admin-remove-btn">
                                    <i class="fa-solid fa-trash"></i>&nbsp; Remove
                                </button>
                                {{-- modal --}}
                                <div class="modal admin-remove-modal">
                                    <div class="modal-content">
                                        <button class="crossX" style="background: none; border: none">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                        <p>Are you sure you want to remove <br />
                                            this user? <br />
                                            He will still be a normal user<br />
                                            after this action</p> <br />
                                        <br>
                                        <h5>Input your password : </h5>
                                        <input type="password" class="form-info input-password">
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
{{ $data->links() }}

@endsection

@section('script_code')

<script>
    $(document).ready(function () {
        $('.data-row').each(function () {
            var row = $(this);
            var adminRemoveModal = row.find('.admin-remove-modal');
            var deleteCloseBtn = adminRemoveModal.find('.crossX');
            var confirmBtn = adminRemoveModal.find('#confirm-remove');
            var cancelBtn = adminRemoveModal.find('#cancel-remove');
            var removeBtn = row.find('.admin-remove-btn');
            var adminRemoveForm = row.find('.admin-remove-form');

            // Show modal when logout button is clicked
            removeBtn.on('click', function (event) {
                event.preventDefault();
                adminRemoveModal.show();
            });

            // Hide modal when 'x' is clicked
            deleteCloseBtn.on('click', function () {
                adminRemoveModal.hide();
            });

            // Hide modal when cancel button is clicked
            cancelBtn.on('click', function () {
                adminRemoveModal.hide();
            });

            // Submit the form when confirm button is clicked
            confirmBtn.on('click', function () {
                var inputPassword = adminRemoveModal.find('.input-password').val();
                row.find('.admin-password').val(inputPassword);
                adminRemoveForm.submit();
            });

            // Hide modal if user clicks outside of the modal content
            $(window).on('click', function (event) {
                if ($(event.target).is(adminRemoveModal)) {
                    adminRemoveModal.hide();
                }
            });
        })
    })
</script>

@endsection