@extends('layouts.template')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Data Petugas</div>

                <div class="card-body">
                    <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
                    <table class="table table-responsive, table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->role }}</td>
                                    <td>
                                        {!! Form::open(['route' => ['user.destroy', $item->id],
                                        'method' => 'DELETE',
                                        'onsubmit' => 'return confirm("Apakah anda yakin ingin menghapus data ini?")'
                                        ]) !!}
                                         <a href="{{ route('user.edit', $item->id) }}" class="btn btn-success btn-sm">Edit</a>
                                        {!! Form::submit('Hapus', ['class' => 'btn btn-danger btn-sm']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @empty($item)
                                    <tr>
                                        <td colspan="5">Data petugas tidak ditemukan</td>
                                    </tr>
                                @endempty
                            @endforeach
                        </tbody>
                    </table>
                    {!! $users->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
