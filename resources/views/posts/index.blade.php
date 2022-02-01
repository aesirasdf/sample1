@extends("layouts.app")

@section('content')
    <div class="container">
        @if(auth()->user()->Profile)
        <form method="POST" action="{{ route("posts-store") }}">
            @csrf
            <div class="form-group mt-4">
                <div class="input-group">
                    <textarea required name="message" id="message" class="form-control" placeholder="What's on your mind?"></textarea>
                    <div class="input-group-append ml-3">
                        <button class="btn btn-primary rounded-3" style="width: 80px; height: 50px; font-size: 22px">POST</button>
                    </div>
                </div>
            </div>
        </form>
        @else
        <div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">
            <strong>Warning!</strong> You can't post anything without updating your profile.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
          @endif
        <div class="row posts">
            @foreach($Posts as $post)
                <div class="col-lg-4 my-4">
                    <div class="card" style="">
                        <div class="card-body">
                            <div class="mb-1 text-left">
                                <h5 class="card-title d-inline">{{ $post->User->Profile->firstname . " " . $post->User->Profile->lastname }}</h5>
                                <div class="d-inline float-right">
                                    <div class="dropdown">
                                        <a type="button" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </a>
                                        <div class="dropdown-menu">
                                            <div class="dropdown-item">
                                                <form action="{{ route("posts-delete", ["id" => $post->id]) }}" method="POST">
                                                    @csrf
                                                    @method("DELETE")
                                                    <input class="toText w-100 text-left" type="submit"  value="Delete">
                                                </form>
                                            </div>
                                            <a class="dropdown-item" href="#">Edit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h6 class="card-subtitle mb-2 text-muted">{{ date_format(date_create($post->created_at), "F d, Y h:i A") }}</h6>
                            <p class="card-text">{{ $post->message }}</p>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection