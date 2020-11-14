@extends('siswa.layouts.layout')
@section('css')
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection
@section('content')
    <div class="container pt-5">
    <center><h2>Informasi Jurusan Di Kelas Anda</h2></center>
    <div class="row pt-5">
        @forelse ($jurusans as $jurusan)
        <div class="col-md-6 col-12">
            <div class="p-2 bg-light rounded-lg">
                <center><h3>{{ $jurusan->jurusan }}</h3></center>
                <p>{{ $jurusan->description }}</p>
            </div>
        </div>
        @empty
            
        @endforelse
    </div>
    <div class="card mt-5">
        <div class="card-header">
            <h5 class="d-inline-block">Pilih Jurusan</h5>
        </div>
        <div class="card-body">
                <form action="{{ route('siswa.jurusan') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <select class="selectpicker" data-live-search="true" name="jurusan">
                            <option value="" disabled {{ auth()->user()->user_profile->kelas_jurusan_id == null ? 'selected' : '' }}>-- Silahkan Pilih Jurusan --</option>
                            @forelse ($jurusans as $jurusan)
                            <option value="{{ $jurusan->pivot->id }}" {{ auth()->user()->user_profile->kelas_jurusan_id == $jurusan->pivot->id ? 'selected' : '' }}>{{ $jurusan->jurusan }}</option>
                            @empty
                                
                            @endforelse
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
        </div>
    </div>
    </div>
@endsection
@section('script')
        <!-- Select Plugin Js -->
       <!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
@endsection