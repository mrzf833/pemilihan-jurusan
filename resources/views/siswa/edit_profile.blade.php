@extends('siswa.layouts.layout')
@section('content')
<div class="container pt-5">
    <div class="card">
        <div class="card-header">
            <h5 class="d-inline-block">Edit Profile</h5>
        </div>
        <div class="card-body">
                <form action="{{ route('siswa.edit') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" aria-describedby="" name="email" value="{{ auth()->user()->email }}">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Jangan Diisi Kalau Tidak Mau diganti">
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}">
                    </div>
                    <div class="form-group">
                        <label for="fullname">Fullname</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" value="{{ auth()->user()->user_profile->fullname }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
        </div>
    </div>
</div>
@endsection