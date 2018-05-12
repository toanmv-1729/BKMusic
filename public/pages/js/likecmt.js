function like_comment(comment_id, user_id, control){
	$.ajax({
		type: "GET", 
		data: {comment_id: comment_id, user_id: user_id, control: control},
		url: "comments/likeComment",
		dataType:'json',
		success: function(data){
			if(data.isFinish == 1){
				if(control == -1){
					$('.control'+comment_id).empty();
					$('.control'+comment_id).html('<img class="angry" src="pages/images/wow.png" />');
				}else if(control == 1){
					$('.control'+comment_id).empty();
					$('.control'+comment_id).html('<i class="fa fa-thumbs-up" aria-hidden="true"></i>');
				}else{
					$('.control'+comment_id).empty();
					$('.control'+comment_id).html('<img class="none" src="pages/images/happy.png" />');
				}
				$('.countIcon'+comment_id).empty();
				$('.countIcon'+comment_id).text(data.countLikecmt);
			}else{
				alert('Vui lòng thử lại sau!');
			}
		}

	});
}

function dislike(comment_id, user_id){
	$.ajax({
		type: "GET", 
		data: {comment_id: comment_id, user_id: user_id},
		url: "comments/dislikeComment",
		dataType:'json',
		success: function(data){
			if(data.isFinish == 1){
				if(data.isLike == 0){
					$('.control'+comment_id).empty();
					$('.control'+comment_id).html('<i class="fa fa-thumbs-up icon-like" aria-hidden="true"></i>');
					$('.countIcon'+comment_id).empty();
					$('.countIcon'+comment_id).text(data.countLikecmt);
				}else{
					$('.control'+comment_id).empty();
					$('.control'+comment_id).html('<i class="fa fa-thumbs-o-up icon-like" aria-hidden="true"></i>');
					$('.countIcon'+comment_id).empty();
					$('.countIcon'+comment_id).text(data.countLikecmt);
				}
			}else{
				alert('Vui lòng thử lại sau!');
			}
		}

	});
}