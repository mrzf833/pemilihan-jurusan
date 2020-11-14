@extends('layouts.layout')
@section('css')
    
    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="{{ asset('plugins/waitme/waitMe.css') }}" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endsection
@section('content')
<div class="container-fluid">
    <!-- Striped Rows -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="d-flex align-item-center justify-content-center">
                        <h2>Pembagian Jurusan</h2>
                        <div>
                            <a class="btn btn-primary btn-lg" href="{{ route('admin.user.create') }}">Create</a>
                        </div>
                    </div>
                </div>
                <div class="body table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Fullname</th>
                                <th>Role</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th>Deskripsi</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->user_profile->fullname }}</td>
                                <td>{{ $user->role->role }}</td>
                                <td>{{ $user->user_profile->kelas->kelas ?? 'Belum Ada Kelas Atau Ini Admin' }}</td>
                                <td>{{ $user->user_profile->kelas_jurusan ? $user->user_profile->kelas_jurusan->jurusan->jurusan : 'Belum Ada Jurusan' }}</td>
                                <td>{{ $user->user_profile->kelas_jurusan ? $user->user_profile->kelas_jurusan->jurusan->description : 'Belum Ada Jurusan' }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>
                                <td>
                                    <div class="d-inline-block">
                                        <form action="{{ route('admin.user.destroy',$user->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn bg-red waves-effect"><i class="material-icons">delete</i></button>
                                        </form>
                                    </div>
                                    <div class="d-inline-block">
                                        <a href="{{ route('admin.user.show',$user->id) }}" class="btn bg-yellow waves-effect m-l-5"><i class="material-icons">edit</i></a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="text-center"><b>Data Not Found</b></td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Striped Rows -->
</div>
@endsection
@section('script')
        <!-- Autosize Plugin Js -->
        <script src="{{ asset('plugins/autosize/autosize.js') }}"></script>

        <!-- Moment Plugin Js -->
        <script src="{{ asset('plugins/momentjs/moment.js') }}"></script>
    
        <!-- Bootstrap Material Datetime Picker Plugin Js -->
        <script src="{{ asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
    
        <!-- Bootstrap Datepicker Plugin Js -->
        <script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
@endsection