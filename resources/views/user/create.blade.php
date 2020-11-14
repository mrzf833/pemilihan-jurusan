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
                            Create User
                        </h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('admin.user.store') }}" autocomplete="off" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="Name" name="name" value="" required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="email" class="form-control" placeholder="Email" name="email" required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" class="form-control" placeholder="Password" name="password" value=" " required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="Fullname" name="fullname" required/>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <select class="form-control show-tick" name="role" id="role" required>
                                            <option value="">-- Please Select Role --</option>
                                            @forelse ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->role }}</option>
                                            @empty
                                                
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group form-float">
                                        <select class="form-control show-tick" name="kelas" id="kelas" required>
                                            <option value="" disabled selected>-- Please Select Kelas --</option>
                                            @forelse ($kelass as $kelas)
                                                <option value="{{ $kelas->id }}">{{ $kelas->kelas }}</option>
                                            @empty
                                                
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group form-float">
                                        <select class="form-control show-tick" name="kelas_jurusan" id="jurusan" disabled>
                                            <option value="" disabled selected>-- Please Select Kelas Terlebih Dahulu --</option>
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
                        if(data[0].jurusan.length > 0){
                            $('#jurusan').attr('disabled',false)
                            $('#jurusan').append('<option value="" disabled selected>-- Please Select Jurusan --</option>')
                        }else{
                            $('#jurusan').attr('disabled',true)
                            $('#jurusan').append('<option value="" disabled selected>-- Jurusan Belum Ada --</option>')
                        }
                        data[0].jurusan.forEach(value => {
                            $('#jurusan').append(`<option value="${value.pivot.id}">${value.jurusan}</option>`)
                        })
                        $('#jurusan').selectpicker('refresh');
                    },
                    error: function(e){
                        $('#jurusan').html('')
                        $('#jurusan').append('<option value="" disabled selected>-- Error --</option>')
                        $('#jurusan').selectpicker('refresh');
                    }
                })
            })

            $(document).on('change','#role',function(){
                $role = $('#role option:selected').text();
                if($role === 'admin'){
                    $('#kelas').attr('required',false)
                }else{
                    $('#kelas').attr('required',true)
                }
            })
        </script>
@endsection