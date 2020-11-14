@extends('layouts.layout')
@section('content')
    <div class="container-fluid">
        <!-- Striped Rows -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <div class="d-flex align-item-center justify-content-center">
                            <h2>Kelas</h2>
                            <div>
                                <button type="button" class="btn btn-primary btn-lg" data-target="#create-modal-kelas" data-toggle="modal">Create</button>
                            </div>
                        </div>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Kelas</th>
                                    <th>Created At</th>
                                    <th>Update At</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kelas as $item)
                                <tr>
                                    <td>{{ $item->kelas }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>
                                        <div class="d-inline-block">
                                            <form action="{{ route('admin.kelas.destroy',$item->id) }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn bg-red waves-effect"><i class="material-icons">delete</i></button>
                                            </form>
                                        </div>
                                        <div class="d-inline-block">
                                            <button type="button" class="btn bg-yellow waves-effect m-l-5" data-target="#edit-modal-kelas-{{ $item->id }}" data-toggle="modal"><i class="material-icons">edit</i></button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center"><b>Data Not Found</b></td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Striped Rows -->
        <div class="modal fade" id="create-modal-kelas" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="title-create-modal">Create Kelas</h4>
                    </div>
                    <form action="{{ route('admin.kelas.store') }}" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        @csrf
                                        <div class="form-line">
                                            <input type="text" class="form-control" required name="kelas">
                                            <label class="form-label">Kelas</label>
                                        </div>
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

        @forelse ($kelas as $item)
            <div class="modal fade" id="edit-modal-kelas-{{ $item->id }}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="title-create-modal">Create Kelas</h4>
                        </div>
                        <form action="{{ route('admin.kelas.edit',$item->id) }}" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group form-float">
                                            @csrf
                                            @method('PATCH')
                                            <div class="form-line">
                                                <input type="text" class="form-control" required name="kelas" value="{{ $item->kelas }}">
                                                <label class="form-label">Kelas</label>
                                            </div>
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