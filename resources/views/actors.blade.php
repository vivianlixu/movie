@extends('master')

@section('content')
    <div class="container p-0 mx-auto bg-dark-70">
        <div class="bg-yellow px-3 py-2">
            <h1 class="text-white m-0">Actors</h1>
        </div>
        <div class="m-5 pb-5">
            <div class="bg-white">
                <table class="table px-3 py-5">
                    <thead>
                        <th>Actor name</th>
                        <th>Roles</th>
                    </thead>
                    <tbody>
                    @foreach($actorsRoles as $actor=>$roles)
                        @if($actor)
                            <tr>
                                <td>{{$actor}}</td>
                                <td>
                                    @foreach($roles as $role)
                                        <p>{{$role}}</p>
                                    @endforeach
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection