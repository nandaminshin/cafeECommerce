@extends('admin.master')

@section('title')
Blog Management
@endsection

@section('header')
<h4 class="fw-bold pt-3"><span class="text-muted fw-light">Admin /</span> Blog Management</h4>
@endsection

@section('active_blog1')
active open
@endsection

@section('active_blog2')
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
                <h5 class="card-header">Blog table</h5>
                <div class="mt-3 ms-5">
                    <form action="{{ route('admin#blog_list') }}" method="get">
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
                            <th>Title</th>
                            <th>Uploaded date</th>
                            <th>Updated date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($data as $item)
                        <tr class="data-row">
                            <td class="max-width-td2"><strong>{{ $item->title }}</strong></td>
                            <td class="max-width-td2">{{ \Carbon\Carbon::parse($item->created_at)->format("l, F j, Y g:i
                                A") }}</td>
                            <td class="max-width-td2">{{ \Carbon\Carbon::parse($item->updated_at)->format("l, F j, Y g:i
                                A") }}</td>
                            <td>
                                <form action="{{ route('admin#remove_blog', $item->id) }}" method="post"
                                    class="blog-remove-form" hidden>
                                    @csrf
                                    <input type="text" name="id" value="{{ Auth::user()->id }}">
                                    <input type="password" class="admin-password" name="password" value="0">
                                </form>
                                <a href="{{ route('admin#admin_blog_detail', $item->id) }}">
                                    <button type="button" class="btn btn-sm rounded-pill btn-outline-primary">
                                        <i class="fa-solid fa-file-lines"></i>&nbsp; Details
                                    </button>
                                </a>
                                <a href="{{ route('admin#edit_blog', $item->id) }}">
                                    <button type="button" class="btn btn-sm rounded-pill btn-outline-primary">
                                        <i class="fa-solid fa-pen"></i>&nbsp; Edit
                                    </button>
                                </a>
                                <button type="button"
                                    class="btn btn-sm rounded-pill btn-outline-primary blog-remove-btn">
                                    <i class="fa-solid fa-trash"></i>&nbsp; Remove
                                </button>
                                {{-- modal --}}
                                <div class="modal blog-remove-modal">
                                    <div class="modal-content">
                                        <button class="crossX" style="background: none; border: none">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                        <p>Are you sure you want to remove <br />
                                            this blog?</p> <br />
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
            var blogRemoveModal = row.find('.blog-remove-modal');
            var deleteCloseBtn = blogRemoveModal.find('.crossX');
            var confirmBtn = blogRemoveModal.find('#confirm-remove');
            var cancelBtn = blogRemoveModal.find('#cancel-remove');
            var removeBtn = row.find('.blog-remove-btn');
            var blogRemoveForm = row.find('.blog-remove-form');

            // Show modal when logout button is clicked
            removeBtn.on('click', function (event) {
                event.preventDefault();
                blogRemoveModal.show();
            });

            // Hide modal when 'x' is clicked
            deleteCloseBtn.on('click', function () {
                blogRemoveModal.hide();
            });

            // Hide modal when cancel button is clicked
            cancelBtn.on('click', function () {
                blogRemoveModal.hide();
            });

            // Submit the form when confirm button is clicked
            confirmBtn.on('click', function () {
                var inputPassword = blogRemoveModal.find('.input-password').val();
                row.find('.admin-password').val(inputPassword);
                blogRemoveForm.submit();
            });

            // Hide modal if user clicks outside of the modal content
            $(window).on('click', function (event) {
                if ($(event.target).is(blogRemoveModal)) {
                    blogRemoveModal.hide();
                }
            });
        })
    })
</script>

@endsection