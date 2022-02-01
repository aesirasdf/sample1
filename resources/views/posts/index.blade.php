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
                                @if($post->user_id == auth()->user()->id)
                                {{-- @if(true) --}}
                                    <div class="d-inline float-right">
                                        <div class="dropdown">
                                            <a type="button" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item edit-button" data-id="{{ $post->id }}" data-message="{{ $post->message }}">Edit</a>
                                                <div class="dropdown-item">
                                                    <form action="{{ route("posts-delete", ["id" => $post->id]) }}" method="POST">
                                                        @csrf
                                                        @method("DELETE")
                                                        <input class="toText w-100 text-left" type="submit"  value="Delete">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <h6 class="card-subtitle mb-2 text-muted">{{ date_format(date_create($post->created_at), "F d, Y h:i A") }}</h6>
                            <p class="card-text">{{ $post->message }}</p>
                            {{-- <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section("modals")
    <div class="modal" id="post-edit-modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Edit Post</h5>
                <button type="button" class="close" id="edit-close-button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form id="post-edit-form" action="" method="POST">
                        @csrf
                        @method("PATCH")
                        <textarea placeholder="What's on your mind?" name="message" id="update-message" class="form-control"></textarea>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="post-update-save" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $(".edit-button").on("click", function(){
                $("#post-edit-form").attr("action", "/posts/" + $(this).attr("data-id"));
                $("#update-message").html($(this).attr("data-message"));
                $("#post-edit-modal").modal("show");
            });
            $("#edit-close-button").click(function(){
                $("#post-edit-modal").modal("hide");
            });
            $("#post-update-save").click(function(){
                $("#post-edit-form").submit();
            });
        });
    </script>
@endsection