@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editing {{ $user->username }}'s Avatar</div>
                </div>
                <div id="menu">
                    @include('users.settings.menu')
                </div>

                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif

                <img src="{{ getAvatarPath($profile->avatar) }}" alt="">


                <div class="container">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('updateAvatar', $user->username) }}"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="custom-file">
                            <input type="file" name="new_avatar" class="custom-file-input" id="new_avatar">
                            <label class="custom-file-label" for="new_avatar">Choose file</label>
                        </div>


                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>


            </div>
        </div>
    </div>
@endsection
