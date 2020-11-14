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
        <div class="block-header">
            <h2>User</h2>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Edit User
                        </h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('admin.user.edit',$user->id) }}" autocomplete="off" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="Name" name="name" value="{{ $user->name }}" required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="email" class="form-control" placeholder="Email" name="email" value="{{ $user->email }}" required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" class="form-control" placeholder="Password" name="password" value=" " required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="Fullname" name="fullname" value="{{ $user->user_profile->fullname }}" required/>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <select class="form-control show-tick" name="role" required>
                                            <option value="">-- Please Select Role --</option>
                                            @forelse ($roles as $role)
                                                <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->role }}</option>
                                            @empty
                                                
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group form-float">
                                        <select class="form-control show-tick" name="kelas" id="kelas" {{ $user->role->role !== 'admin' ? 'required' : '' }}>
                                            <option value="" selected>-- Please Select Kelas --</option>
                                            @forelse ($kelass as $kelas)
                                                <option value="{{ $kelas->id }}" {{ $user->user_profile->kelas_id == $kelas->id ? 'selected' : '' }}>{{ $kelas->kelas }}</option>
                                            @empty
                                                
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group form-float">
                                        <select class="form-control show-tick" name="kelas_jurusan" id="jurusan" {{ !count($jurusans) > 0 ? 'disabled' : '' }}>
                                            @if (count($jurusans) > 0)
                                                <option value="" disabled selected>-- Please Select Jurusan --</option>
                                            @endif
                                            @forelse ($jurusans as $jurusan)
                                                <option value="{{ $jurusan->pivot->id }}" {{ $user->user_profile->kelas_jurusan_id == $jurusan->pivot->id ? 'selected' : '' }}>{{ $jurusan->jurusan }}</option>
                                            @empty
                                                <option value="" disabled selected>-- Jurusan Belum Ada --</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group form-float">
                                        <button type="submit" class="btn btn-primary btn-lg pull-right">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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

        <script src="{{ asset('js/pages/forms/basic-form-elements.js') }}"></script>
        <script>
            $(document).on('change','#kelas',function(){
                $.ajax({
                    beforeSend:function(){
                        $('#jurusan').attr('disabled',true)
                        $('#jurusan').html('')
                        $('#jurusan').append('<option value="" disabled selected>-- Loading --</option>')
                        $('#jurusan').selectpicker('refresh')
                    },
                    url: "{{ route('search_jurusan') }}",
                    type: 'GET',
                    data: {
                        kelas: $(this).val()
                    },
                    success: function(data){
                        $('#jurusan').html('')
                        if(data[0].jurusan != undefined && data[0].jurusan.length > 0){
                            $('#jurusan').attr('disabled',false)
                            $('#jurusan').append('<option value="" disabled selected>-- Please Select Jurusan --</option>')
                        }else{
                            $('#jurusan').attr('disabled',true)
                            $('#jurusan').append('<option value="" disabled selected>-- Jurusan Belum Ada --</option>')
                        }
                        data[0].jurusan.forEach(value => {
                            $('#jurusan').append(`<option value="${value.pivot.id}" ${value.pivot.id == "{{ $user->user_profile->kelas_jurusan_id }}" ? 'selected' : ''}>${value.jurusan}</option>`)
                        })
                        $('#jurusan').selectpicker('refresh');
                    },
                    error: function(e){
                        $('#jurusan').html('')
                        $('#jurusan').append('<option value="" disabled selected>-- Error Atau Select Kelas Terlebih Dahulu --</option>')
                        $('#jurusan').selectpicker('refresh');
                    }
                })
            })
        </script>
@endsection