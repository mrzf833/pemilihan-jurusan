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
                            <button type="button" class="btn btn-primary btn-lg" data-target="#create-modal-pembagian-jurusan" data-toggle="modal">Create</button>
                        </div>
                    </div>
                </div>
                <div class="body table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th>Deskripsi</th>
                                <th>Created At</th>
                                <th>Update At</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kelas_jurusans as $item)
                            <tr>
                                <td>{{ $item->kelas->kelas }}</td>
                                <td>{{ $item->jurusan->jurusan }}</td>
                                <td>{{ $item->jurusan->description }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td>
                                    <div class="d-inline-block">
                                        <form action="{{ route('admin.pembagian_jurusan.destroy',$item->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn bg-red waves-effect"><i class="material-icons">delete</i></button>
                                        </form>
                                    </div>
                                    <div class="d-inline-block">
                                        <button type="button" class="btn bg-yellow waves-effect m-l-5" data-target="#edit-modal-pembagian-jurusan-{{ $item->id }}" data-toggle="modal"><i class="material-icons">edit</i></button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center"><b>Data Not Found</b></td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Striped Rows -->
    <div class="modal fade" id="create-modal-pembagian-jurusan" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="title-create-modal">Create Pembagian Jurusan</h4>
                </div>
                <form action="{{ route('admin.pembagian_jurusan.store') }}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row clearfix">
                            @csrf
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <select class="form-control show-tick" name="kelas">
                                        <option value="">-- Please Select Kelas --</option>
                                        @forelse ($kelas as $item)
                                            <option value="{{ $item->id }}">{{ $item->kelas }}</option>
                                        @empty
                                            
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <select class="form-control show-tick" name="jurusan">
                                        <option value="">-- Please Select Jurusan --</option>
                                        @forelse ($jurusans as $item)
                                            <option value="{{ $item->id }}">{{ $item->jurusan }}</option>
                                        @empty
                                            
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-link waves-effect">SUBMIT</button>
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @forelse ($kelas_jurusans as $kelas_jurusan)
        <div class="modal fade" id="edit-modal-pembagian-jurusan-{{ $kelas_jurusan->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="title-create-modal">Create Jurusan</h4>
                    </div>
                    <form action="{{ route('admin.pembagian_jurusan.edit',$kelas_jurusan->id) }}" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row clearfix">
                                @csrf
                                @method('PATCH')
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <select class="form-control show-tick" name="kelas">
                                            <option value="">-- Please Select Kelas --</option>
                                            @forelse ($kelas as $item)
                                                <option value="{{ $item->id }}" {{ $item->id == $kelas_jurusan->kelas_id ? 'selected' : '' }}>{{ $item->kelas }}</option>
                                            @empty
                                                
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <select class="form-control show-tick" name="jurusan">
                                            <option value="">-- Please Select Jurusan --</option>
                                            @forelse ($jurusans as $item)
                                                <option value="{{ $item->id }}" {{ $item->id == $kelas_jurusan->jurusan_id ? 'selected' : '' }}>{{ $item->jurusan }}</option>
                                            @empty
                                                
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-link waves-effect">SUBMIT</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @empty
        
    @endforelse
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