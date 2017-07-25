<!DOCTYPE html>
<html>
<head>
	<title>My Twitter App</title>
	<link rel="stylesheet" type="text/css" href="https://bootswatch.com/cerulean/bootstrap.min.css">
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<a href="/" class="navbar-brand">MyTwitter</a>
			</div>
		</div>
	</nav>
	<div class="container">
		<form action="{{route('tweet.post')}}" method="post" class="well" enctype="multipart/form-data">
			{{ csrf_field() }}
			@if(count($errors) > 0)
				@foreach($errors->all() as $error)
				   <div class="alert alert-danger">
					  {{ $error }}
				   </div>
				@endforeach
			@endif
			<div class="form-group">
				<label>Your Tweet</label>
				<input type="text" name="tweet" class="form-control">
			</div>
			<div class="form-group">
				<label>Upload Images</label>
				<input type="file" name="images[]" multiple class="form-control">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success">Create Tweet</button>
			</div>
		</form>
		@if(!empty($data))
			@foreach($data as $tweet)
				<div class="well">
					<h3>{{$tweet['text']}}s
					 <i class="glyphicon glyphicon-heart">{{ $tweet['favorite_count']}}</i>
					 <i class="glyphicon glyphicon-repeat">{{ $tweet['retweet_count']}}</i>
					</h3>
					@if(!empty($tweet['extended_entities']['media']))
						@foreach($tweet['extended_entities']['media'] as $image)
							<img src="{{$image['media_url_https']}}" style="width:100px;">
						@endforeach
					@endif
				</div>
			@endforeach
		@else
			<p>No Tweetz Fount!!!!</p>
		@endif
	</div>
</body>
</html>