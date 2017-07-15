@extends ('layouts.master')

@section('content')
	@include('includes.message-block')
	
	<section class="row new-post">

		{{-- Imagen de perfil --}}
		<div class="col-md-3">
			<span class="pull-right">
				{{-- <img src="{{ route('account.image', ['filename' => Auth::user()->name . '-' . Auth::user()->id . '.jpg']) }}" alt="" class="img-responsive" style="max-height: 200px;"> --}}
				<img src="{{Auth::user()->img}}" style="max-height: 200px;">
			</span>
		</div>

		{{-- Publicar post --}}
		<div class="col-md-6">
			<header>
				<h3>What do you have to say?</h3>
			</header>
			<form action="{{route('post.create')}}" method="post" name="nuevo">
				<div class="form-group">
					<textarea name="body" 
					id="new-post" 
					rows="5" 
					placeholder="Your post"
					class="form-control"></textarea>
				</div>
				<button type="submit" class="btn btn-primary">Create post</button>
				<input type="hidden" name="_token" value="{{ Session::token() }}">
			</form>
		</div>
	</section>


	<section>
		<section class="row posts">
			<div class="col-md-8 col-md-offset-2">
				<header><h3>What other people say...</h3></header>
				@foreach ($posts as $post)
					<div class="row">

						{{-- Imagen de perfil del post --}}
						<div class="col-md-2">
{{-- 							<img src="{{ route('account.image', ['filename' => $post->user1->name . '-' . $post->user1->id . '.jpg']) }}" alt="" class="img-responsive" style="max-height: 100px;"> --}}
							<img src="{{ $post->user1->img }}" alt="" class="img-responsive" style="max-height: 100px;">
						</div>

						{{-- Post --}}
						<div class="col-md-5">
							<article class="post" data-postid="{{ $post->id }}">
								<p>{{$post->body}}</p>
								<div class="info">
									Posted by {{$post->user1->name}} on {{$post->created_at}}
								</div>
								<div class="interaction">

									<a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this' : 'Like' : 'Like'  }}</a>
									<span class="likes">{{$post->likes}}</span>
									
									|
									<a href="#" class="like">{{Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You don\'t like this' : 'Dislike' : 'Dislike'  }}</a>
									<span class="dislikes">{{$post->dislikes}}</span>
									@if (Auth::user() == $post->user1)
										| 
										<a href="#" class="edit">Edit</a> |
										<a href="{{ route('post.delete', ['post_id' =>$post->id]) }}">Delete</a>
									@endif
								</div>
							</article>
						</div>
					</div>
					
					
				@endforeach
			</div>
		</section>

		<div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title">Edit Post</h4>
		      </div>
		      <div class="modal-body">
				<form>
					<div class="form-group">
						<label for="post-body">Edit the post</label>
						<textarea name="post-body" id="post-body" rows="5" class="form-control"></textarea>
					</div>
				</form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	</section>
	<script>
		var token = '{{Session::token()}}';
		var urlEdit = '{{route('edit')}}';
		var urlLike = '{{route('like')}}';
	</script>
@endsection