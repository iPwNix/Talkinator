@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $user->username }}</div>
                    <p>
                        <img src="{{ getProfileCoverPath($profile->profile_cover) }}" alt="">
                    </p>

                    <p>
                        <img src="{{ getAvatarPath($profile->avatar) }}" alt="">
                    </p>

                </div>
            </div>
        </div>
    </div>
@endsection
