@extends('layouts.app')

@section('title', 'Users')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
<link rel="stylesheet" href="{{ asset('library/sweetalert/dist/sweetalert2.min.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>All Users</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Users</a></div>
                <div class="breadcrumb-item">All Users</div>
            </div>
        </div>
        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Users</h4>
                            <div class="section-header-button">
                                <a href="{{ route('user.create') }}" class="btn btn-primary">New User</a>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="float-right">
                                <form method="GET" , action="{{ route('user.index') }}">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search" name="name">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table-striped table" id="main-table">
                                    <tr>

                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            {{ $user->name }}
                                        </td>
                                        <td>
                                            {{ $user->email }}
                                        </td>
                                        <td>
                                            {{ $user->phone }}
                                        </td>
                                        <td>
                                            {{ $user->created_at }}
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href='{{ route('user.edit', $user->id) }}' class="btn btn-sm
                                                    btn-info btn-icon"> <i class="fas fa-edit"></i>
                                                    Edit
                                                </a>
                                                {{-- <form action="{{ route('user.destroy', $user->id) }}"
                                                    method="POST">
                                                    @csrf --}}
                                                    {{-- <input type="hidden" name="_method" value="DELETE" /> --}}
                                                    <button class="ml-2 btn btn-sm btn-danger btn-icon confirm-delete"
                                                        id="delete" data-id="{{ $user->id }}">
                                                        <i class="fas fa-times"></i> Delete
                                                    </button>
                                                    {{--
                                                </form> --}}
                                            </div>

                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                            <div class="float-right">
                                {{ $users->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('library/sweetalert/dist/sweetalert2.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/features-posts.js') }}"></script>
<script>
    $(document).on("click", "button#delete", function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        showDeletePopup('{{ url('') }}/user/' + id, '{{ csrf_token() }}', '{{ url('') }}/user');
    });

    function showDeletePopup(url, token, reload) {
      Swal.fire({
        title: 'Are You Sure?',
        text: "Are You Sure Delete This Data?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Yes!',
        cancelButtonText: 'Cancel',
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
              url: url,
              "headers": {
                'X-CSRF-TOKEN':'{{ csrf_token() }}'
              },
              type: "DELETE"
            })
            .done(function(data) {
              if (data.status == 'success') {
                Swal.fire("Deleted!", "Data has succesfully deleted!", "success");
                setTimeout(function() {
                    Swal.close()
                    window.location.replace(reload);
                }, 1000);
              } else {
                Swal.fire("Error!", data.message, "error");
              }
            })
            .fail(function(data) {
              Swal.fire("Oops", "We couldn't connect to the server!", "error");
            });
        }
      })
    }
</script>
@endpush