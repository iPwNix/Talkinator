@extends('layouts.app', ['body_class' => 'profile'])

@section('content')
    <div class="container-fluid">
        <div class="row profile-cover-row">
            <div class="col-xs-12 profile-cover-col"
                 style="background-image: url({{ getProfileCoverPath($profile->profile_cover) }})"></div>
            <div class="cover-darken-overlay"></div>
            <div class="container cover-bio-container">
                <div class="row">
                    <div class="cover-info">
                        <div class="cover-avatar"
                             style="background-image: url({{ getAvatarPath($profile->avatar) }})"></div>
                        <div class="cover-bio">
                            <h2 class="cover-username">{{ $user->username }}</h2>
                            <!-- @todo add role check-->
                            @if(auth()->id() == $user->id)
                                <a class="cover-edit-btn" href="{{ route('editInfo', $user->username) }}">Edit</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="profile-nav">
            <div class="container">
                <div class="row">
                    <div class="nav">
                        <a href="{{ $user->username }}/activity">Activity</a>
                        <a href="{{ $user->username }}/threads">Threads</a>
                        <a href="{{ $user->username }}/replies">Replies</a>
                        <a href="{{ $user->username }}/comments">Comments</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
@endsection


@section('specific_scripts')
    <script src="{{ asset('js/profile.js') }}"></script>
@stop