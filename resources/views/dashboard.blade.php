@extends ('layouts.master')

@section('content')
	@include('includes.message-block')
	<section class="row new-post">
		<div class="col-md-6 col-md-offset-3">
			<header>
				<h3>What do you have to say?</h3>
			</header>
			<form action="{{route('post.create')}}" method="post">
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
			<div class="col-md-6 col-md-offset-3">
				<header><h3>What other people say...</h3></header>
				<article class="post">
					<p>Un hombre fue atropellado durante el "trancazo" realizado en El Hatillo por un conductor  en la redoma del SportCenter de Los Naranjos.</p>
					<div class="info">
						Posted by Diego on 12 fe 1016
					</div>
					<div class="interaction">
						<a href="#">Like</a> |
						<a href="#">Dislike</a> |
						<a href="#">Edit</a> |
						<a href="#">Delete</a>
					</div>
				</article>
				<article class="post">
					<p>El alcalde de El Hatillo, David Smolansky, informó en su cuenta de Twitter que el individuo conducía un corolla gris y que luego de atropellar al hombre intentó darse a la fuga. </p>
					<div class="info">
						Posted by Diego on 12 fe 1016
					</div>
					<div class="interaction">
						<a href="#">Like</a> |
						<a href="#">Dislike</a> |
						<a href="#">Edit</a> |
						<a href="#">Delete</a>
					</div>
				</article>
			</div>
		</section>
	</section>

@endsection