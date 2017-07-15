var postId = 0;
var postBodyElement;





$('#image').on('change', function(){
	if(this.files && this.files[0]){
		document.getElementById('boton').setAttribute('disabled','');
		var image = this.files[0];
		var storageRef = firebase.storage().ref();
		var uploadTask = storageRef.child('imagenes/' + image.name).put(image);
		uploadTask.on('state_changed', function(snapshot){
		  var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
		  console.log('Upload is ' + progress + '% done');
		  switch (snapshot.state) {
		    case firebase.storage.TaskState.PAUSED: // or 'paused'
		      console.log('Upload is paused');
		      break;
		    case firebase.storage.TaskState.RUNNING: // or 'running'
		      console.log('Upload is running');
		      break;
		  }
		}, function(error) {
		}, function() {
		  var downloadURL = uploadTask.snapshot.downloadURL;
			document.getElementById("url").setAttribute('value', downloadURL);
			document.getElementById("view").setAttribute('src', downloadURL);
			document.getElementById("boton").removeAttribute('disabled');
		});	}
});

$('.post').find('.interaction').find('.edit').on('click', function(){
	event.preventDefault();
	postBodyElement = event.target.parentNode.parentNode
	.childNodes[1];
	var postBody = postBodyElement.textContent;
	postId = event.target.parentNode.parentNode
	.dataset['postid'];
	$('#post-body').val(postBody);
	$('#edit-modal').modal();
});

$('#modal-save').on('click', function () {
	$.ajax({
			method: 'POST',
			url: urlEdit,
			data:{
				body: $('#post-body').val(), 
				postId: postId,
				_token: token
			}
	}).done(function (msg) {
		$(postBodyElement).text(msg['new_body']);
		$('#edit-modal').modal('hide');
	});
});

$('.like').on('click', function(event) {
	event.preventDefault();
	postId = event.target.parentNode.parentNode
	.dataset['postid'];
	likes = event.target.parentNode.childNodes[3];
	dislikes = event.target.parentNode.childNodes[7];
	var isLike = event.currentTarget.innerText == 'Like' || event.currentTarget.innerText == 'You like this';
	$.ajax({
		method: 'POST',
		url: urlLike,
		data: {
			isLike: isLike,
			postId: postId,
			_token: token
		}
	})
	.done(function(msg){
		console.log('Respuesta: '+msg['respuesta']+'\t'+'Likes: '+msg['post_likes']+'\t'+'Dislikes: '+msg['post_dislikes'])
		event.target.innerText = isLike ? (event.target.innerText == 'Like' ? 'You like this' : 'Like') : (event.target.innerText == 'Dislike' ? 'You don\'t like this' : 'Dislike');
		if(isLike){
			event.target.nextElementSibling.nextElementSibling.innerText = 'Dislike';
			$(likes).text(msg['post_likes']);
			$(dislikes).text(msg['post_dislikes']);
		}
		else {
			$(dislikes).text(msg['post_dislikes']);
			$(likes).text(msg['post_likes']);
			event.target.previousElementSibling.previousElementSibling.innerText = 'Like';
		}
	});

});

