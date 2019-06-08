@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                        <br><br>

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">ID#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Joined at</th>
                                <th scope="col">Verified</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td scope="row">{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                <td>{{ date('F j, Y, g:i a', strtotime($user->created_at)) }}</td>
                                <td>
                                    @if(is_null($user->email_verified_at))
                                        <span class="badge badge-danger">&#10005;&nbsp;unverified</span>
                                    @else
                                        <span class="badge badge-success">&#10003;&nbsp;verified</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

