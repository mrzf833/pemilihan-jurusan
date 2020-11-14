@extends('siswa.layouts.layout')
@section('content')
    <div class="container pt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="d-inline-block">Profile</h5>
                <a href="{{ route('siswa.show') }}" class="btn btn-info float-right d-inline-block">Edit</a>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th bgcolor="#FBFBFB">Name</th>
                            <td>{{ auth()->user()->name }}</td>
                        </tr>
                        <tr>
                            <th bgcolor="#FBFBFB">Email</th>
                            <td>{{ auth()->user()->email }}</td>
                        </tr>
                        <tr>
                            <th bgcolor="#FBFBFB">Fullname</th>
                            <td>{{ auth()->user()->user_profile->fullname }}</td>
                        </tr>
                        <tr>
                            <th bgcolor="#FBFBFB">Kelas</th>
                            <td>{{ auth()->user()->user_profile->kelas->kelas }}</td>
                        </tr>
                        <tr>
                            <th bgcolor="#FBFBFB">Jurusan</th>
                            <td>{{ auth()->user()->user_profile->kelas_jurusan ? auth()->user()->user_profile->kelas_jurusan->jurusan->jurusan : 'Belum Ada Jurusan'  }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection