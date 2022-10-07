@extends('dashboard.layouts.master')
@extends('dashboard.layouts.sidebar')
@extends('dashboard.layouts.wrap')
@extends('dashboard.layouts.navbar')
@section('content')
<script src="//code.jquery.com/jquery.js"></script>
        <!-- DataTables -->
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>


<div class="container-fluid py-4">
    <div class="row">
        <div class="card">
            <div class="card-header">Daftar User</div>

            <div class="card-body">
                <a href="#" class="btn btn-sm btn-success mb-2">Tambah Data</a>
                <table class="table table-bordered" id="users-table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>No_hp</th>
                            <th>Role</th>
                            <th>Gender</th>

                            {{-- <th>Created At</th>
                            <th>Updated At</th> --}}
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>
</div>

<script>
    $(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('/home/users/list') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'username', name: 'username' },
                { data: 'no_hp', name: 'no_hp' },
                { data: 'role', name: 'role' },
                { data: 'gender', name: 'gender' },
            ]
        });
    });
    </script>


@endsection

{{-- @extends('dashboard.layouts.footer') --}}
@extends('dashboard.layouts.endwrap')

