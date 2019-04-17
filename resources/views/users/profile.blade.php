@extends('layouts.app', ['body_class' => 'profile'])

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


@section('specific_scripts')
    <script src="{{ asset('js/profile.js') }}"></script>
@stop