// Confirm Login
function confirmLogin(){
	alert('Please Login!');
}

// Add comment
function addComment(music_id){
	$.ajax({
		type: "GET",
		data: {comment: $('.comment-input').val(), music_id: music_id},
		url: "comments/addComment",
		dataType: 'json',
		success: function(data) {
			if(data.control == 1){
				var html = '<div class="comments'+data.comment_id+'">' +
				'<div style="margin-bottom:10px">' + 
				'<img class="avatar-user" src="upload/user/'+data.urlanh+'" width="30px" />' +
				'<p style="margin-bottom:0px">' + 
				'<b>'+data.username+'</b>' +
				'<span class="span'+data.comment_id+'" style="margin-left:10px">'+data.comment+' </span>' +
				'<span class="edit-div'+data.comment_id+'"></span>' +
				'</p>' +
				'<span class="countIcon'+data.comment_id+'">0</span>' +
				' <span class="checkLike-comment'+data.comment_id+'">' +
				'<span>' +
				'<ul class="fbicon contain-icon">' +
				'<li>' +
				'<a class = "control'+data.comment_id+'" onclick="dislike('+data.comment_id+','+data.user_id+')">' +
				'<i class="fa fa-thumbs-o-up icon-like" aria-hidden="true"></i>' +
				'</a>' +
				'<ul class="show-icon">' + 
				'<li>' +
				'<a class="heart" onclick="like_comment('+data.comment_id+','+data.user_id+',1)">' +
				'<i class="fa fa-thumbs-up icon-like" aria-hidden="true"></i>' +
				'</a>' +
				'</li>' +
				'<li>' +
				'<a  onclick="like_comment('+data.comment_id+','+data.user_id+',-1)">' +
				'<img class="angry" src="pages/images/wow.png" />' +
				'</a>' +
				'</li>' +
				'<li>' +
				'<a onclick="like_comment('+data.comment_id+','+data.user_id+',0)">' +
				'<img class="none" src="pages/images/happy.png" />' +
				'</a>' +
				'</li>' +
				'</ul>' +
				'</li>' +
				'</ul>' +
				'</span> ' +
				'<a class="action" onclick="removeComment('+data.comment_id+','+music_id+')">Delete </a>' +
				'<span class="reply-span'+data.comment_id+'">' +
				'<a class = "action reply'+data.comment_id+'" onclick = "load_reply('+data.comment_id+')" style="font-size: 12px">Reply </a>' +
				'</span>' +
				'<span class = "removeEdit'+data.comment_id+'">' +
				'<a class = "action edit'+data.comment_id+'" onclick="edit('+data.comment_id+')" style="font-size: 12px"> Edit </a>' +
				'</span>' +
				'<span class="dt"><i>'+data.created_at+'</i></span>' +
				'<div class = "loadReply loadMore'+data.comment_id+'"></div>' +
				'</div>' +
				'</div>';

				$('.newComment').append(html);
				$('.comment-input').val('');
				$('.comment-input').focus();
			}else{
				alert('Vui lòng thử lại sau!');
			}
		}
	});
}

function removeComment(comment_id, music_id){
	if(confirm('Delete?')){
		$.ajax({
			type: "GET",
			data: {comment_id: comment_id, music_id: music_id},
			url: "comments/removeComment",
			dataType: 'text',
			success: function(data) {
				$('.comments'+comment_id).remove();
			}

		});
		return false;
	} else{
		return false;
	}
}

function edit(comment_id){
	$.ajax({
		type: "GET",
		data: {comment_id: comment_id},
		url: "comments/edit",
		dataType: 'json',
		success: function(data) {
			var html = '<input class="form-edit edit-input'+comment_id+'" style="width: 50%, display: inherit" type="text" name="edit" value = "'+data.comment+'" />' +
			'<input class="form-success edit-submit edit-submit'+comment_id+'" onclick="edit_save('+comment_id+')" type="submit" value="Save" />';
			$('.edit-div'+comment_id).append(html);
			$('.edit'+comment_id).remove();
			$('.span'+comment_id).empty();
		}
	});
}

function edit_save(comment_id){
	$.ajax({
		type: "GET", 
		data: {comment: $('.edit-input'+comment_id).val(), comment_id: comment_id},
		url: "comments/editSave",
		dataType:'json',
		success: function(data){
			if(data.isFinish == 1){
				var html = '<a class = "action edit'+comment_id+'" onclick = "edit('+comment_id+')" style="font-size: 12px"> Edit</a>';

				$('.edit-input'+comment_id).remove();
				$('.edit-submit'+comment_id).remove();
				$('.span'+comment_id).text(data.comment);
				$('.removeEdit'+comment_id).html(html);
			}else{
				alert('Vui lòng thử lại sau!');
			}
		}
	});
}

// Load reply comment
function load_reply(comment_id){
	$.ajax({
		type: "GET", 
		data: {comment_id: comment_id},
		url: "comments/loadReply",
		dataType:'json',
		success: function(data){
			html = '<span class = "reply-comment'+comment_id+'">' +
			'<span class = "reply-add'+comment_id+'">';
			infomation = data.Replies;

			for (x in infomation) {
				formatLike = "";
            	//Check session user
            	if(data.user_id != 0){
            		if(data.isLike[x] == 0){
            			formatLike += '<a class = "control'+infomation[x]['id']+'" onclick="dislike('+infomation[x]['id']+','+data.user_id+')">' + 
            			'<i class="fa fa-thumbs-o-up icon-like" aria-hidden="true"></i>' +
            			'</a>';
            		}else{
            			if(data.control[x] == 1){
            				formatLike += '<a class = "control'+infomation[x]['id']+'" onclick="dislike('+infomation[x]['id']+','+data.user_id+')">' +
            				'<i class="fa fa-thumbs-up icon-like" aria-hidden="true"></i>' +
            				'</a>';
            			}else if(data.control[x] == 0){
            				formatLike += '<a class = "control'+infomation[x]['id']+'" onclick="dislike('+infomation[x]['id']+','+data.user_id+')">' +
            				'<img class="angry" src="pages/images/happy.png" />' +
            				'</a>';
            			}else{
            				formatLike += '<a class = "control'+infomation[x]['id']+'" onclick="dislike('+infomation[x]['id']+','+data.user_id+')">' +
            				'<img class="none" src="pages/images/wow.png" />' +
            				'</a>';
            			}
            		}
            	}

            	html += '<div class=" subcomment comments'+infomation[x]['id']+'">' +
            	'<img class="avatar-user" src="upload/user/'+data.urlanh[x]+'" width="30px" />' +
            	'<p style="margin-bottom: 0px">' +
            	'<b>'+data.usernameReply[x]+'</b>' +
            	'<span class = "span'+infomation[x]['id']+'" style="margin-left: 10px">'+infomation[x]['comment']+'</span>' +
            	'<span class="edit-div'+infomation[x]['id']+'"></span>' +
            	'</p>' +
            	'<span class="countIcon'+infomation[x]['id']+'">'+data.countLike[x]+' </span>';

            	//Check session user
            	if(data.user_id != 0){
            		html += '<span>' +
            		'<ul class="fbicon contain-icon">' +
            		'<li>' + formatLike +
            		'<ul class="show-icon">' +
            		'<li>' +
            		'<a class="heart" onclick="like_comment('+infomation[x]['id']+','+data.user_id+',1)">' +
            		'<i class="fa fa-thumbs-up icon-like" aria-hidden="true"></i>' +
            		'</a>' +
            		'</li>' +
            		'<li>' +
            		'<a onclick="like_comment('+infomation[x]['id']+','+data.user_id+',-1)">' +
            		'<img class="angry" src="pages/images/wow.png" />' +
            		'</a>' +
            		'</li>' +
            		'<li>' +
            		'<a onclick="like_comment('+infomation[x]['id']+','+data.user_id+',0)">' +
            		'<img class="none" src="pages/images/happy.png" />' +
            		'</a>' +
            		'</li>' +
            		'</ul>' +
            		'</li>' +
            		'</ul>' +
            		'</span>';

            		if(data.user_id == infomation[x]['user_id']){
            			html += '<a class = "action" onclick="removeReply('+infomation[x]['id']+')"> Delete </a>' +
            			'<span class ="removeEdit'+infomation[x]['id']+'">' +
            			'<a class = " action edit'+infomation[x]['id']+'" onclick = "edit('+infomation[x]['id']+')" style="font-size: 12px"> Edit </a>' +
            			'</span>' +
            			'<span class="dt"><i> '+data.created_at[x]+'</i></span>';

            		}
            	}else{
            		html += '<a onclick = "confirmLogin()"> <i class="fa fa-thumbs-o-up icon-like" aria-hidden="true"></i></a>';
            		html += '<span class="dt"><i> '+data.created_at[x]+'</i></span>';
            	}

            	html += '</div>';

            }

        	//Check session user
        	if(data.user_id != 0){
        		html += 	'</span>' +
        		'<input class="form-edit reply-input'+comment_id+'" style="width: 50%, display: inherit" type="text" name="edit">' +
        		'<input class="form-success" onclick="reply('+comment_id+')" type="submit" value="Send">' +
        		'</span>';
        	}else{
        		html += 	'</span>' +
        		'</span>';
        	}

        	$('.loadMore'+comment_id).append(html);
        	$('.reply-span'+comment_id).empty();
        	$('.reply-span'+comment_id).html('<a class = "action reply_now'+comment_id+'" onclick = "reply_now('+comment_id+')" style="font-size: 12px"> Reply </a>');
        	$('.reply-hidden'+comment_id).empty();

        	if(data.countReply != 0){
        		hidden = '<a class = "action reply'+comment_id+'" onclick = "hidden_reply('+comment_id+')">' +
        		'<i class="fa fa-chevron-up" aria-hidden="true"></i>' +
        		'</a>' +
        		'<a class = "action reply'+comment_id+'" onclick = "hidden_reply('+comment_id+')"><span class = "contain-count-reply'+comment_id+'"> '+data.countReply+' </span> replies</a>';

        		$('.reply-hidden'+comment_id).append(hidden);
        		$('.isReply'+comment_id).addClass('hidden-decoration');		
        	}
        }
    });
}

function removeReply(comment_id){
	if(confirm('Delete?')){
		$.ajax({
			type: "GET",
			data: {comment_id: comment_id},
			url: "comments/removeReply",
			dataType: 'json',
			success: function(data) {
				if(data.isFinish == 1){
					if(data.countReply == 0){
						$('.reply-hidden'+data.parent_id).empty();
					}else{
						$('.contain-count-reply'+data.parent_id).empty();
						$('.contain-count-reply'+data.parent_id).append(' '+data.countReply);
					}

					$('.comments'+comment_id).remove();
				}else{
					alert('Vui lòng thử lại sau!');
				}
			}
		});
		return false;
	} else{
		return false;
	}
}

function reply(comment_id){
	$.ajax({
		type: "GET", 
		data: {comment: $('.reply-input'+comment_id).val(), comment_id: comment_id},
		url: "comments/reply",
		dataType:'json',
		success: function(data){
			if(data.isFinish == 1){
				html = '<div class="comments'+data.comment_id+'">' +
				'<img class="avatar-user" src="upload/user/'+data.urlanh+'" width="30px" />' +
				'<p style="margin-bottom: 0px">' +
				'<b>'+data.username+'</b>' +
				'<span class = "span'+data.comment_id+'" style="margin-left: 10px">'+data.comment+'</span>' +
				'<span class="edit-div'+data.comment_id+'"></span>' +
				'</p>' +
				'<span class="countIcon'+data.comment_id+'">0 </span>' +
				'<span>' +
				'<ul class="fbicon contain-icon">' +
				'<li>' +
				'<a class = "control'+data.comment_id+'" onclick="dislike('+data.comment_id+','+data.user_id+')">' +
				'<i class="fa fa-thumbs-o-up icon-like" aria-hidden="true"></i>' +
				'</a>' +
				'<ul>' +
				'<li>' +
				'<a onclick="like_comment('+data.comment_id+','+data.user_id+',1)">' +
				'<i class="fa fa-thumbs-up icon-like" aria-hidden="true"></i>' +
				'</a>' +
				'</li>' +
				'<li>' +
				'<a  onclick="like_comment('+data.comment_id+','+data.user_id+',-1)">' +
				'<img class="angry" src="pages/images/wow.png" />' +
				'</a>' +
				'</li>' +
				'<li>' +
				'<a  onclick="like_comment('+data.comment_id+','+data.user_id+',0)">' +
				'<img class="none" src="pages/images/happy.png" />' +
				'</a>' +
				'</li>' +
				'</ul>' +
				'</li>' +
				'</ul>' +
				'</span>' +
				'<a class="action" onclick="removeReply('+data.comment_id+')"> Delete </a>' +
				'<span class ="removeEdit'+data.comment_id+'">' +
				'<a class = " action edit'+data.comment_id+'" onclick = "edit('+data.comment_id+')" style="font-size: 12px">Edit </a>' +
				'</span>' +
				'<span class="dt">' +
				'<i> ' + data.created_at + '</i>' +
				'</span>' +
				'</div>';

				if(data.countReply == 1){
					hidden = '<a class = "action reply'+comment_id+'" onclick = "hidden_reply('+comment_id+')">' +
					'<i class="fa fa-chevron-up" aria-hidden="true"></i>' +
					'</a>' +
					'<a class = "action reply'+comment_id+'" onclick = "hidden_reply('+comment_id+')"><span class = "contain-count-reply'+comment_id+'"> '+data.countReply+' </span> replies</a>';

					$('.reply-hidden'+comment_id).append(hidden);
					$('.isReply'+comment_id).addClass('hidden-decoration');
				}else{
					$('.contain-count-reply'+comment_id).empty();
					$('.contain-count-reply'+comment_id).append(' '+data.countReply);
				}

				$('.reply-add'+comment_id).append(html);
				$('.reply-input'+comment_id).val('');
			}else{
				alert('Vui lòng thử lại sau!');
			}
		}
	});
}

// Action focus reply
function reply_now(comment_id){
	$('.reply-input'+comment_id).focus();
}

function hidden_reply(comment_id){
	$.ajax({
		type: "GET",
		data: {comment_id: comment_id},
		url: "comments/hiddenReply",
		dataType: 'json',
		success: function(data) {
			$('.loadMore'+comment_id).empty();
			$('.reply-hidden'+comment_id).empty();

			show = '<a class = "action reply'+comment_id+'" onclick = "load_reply('+comment_id+')">' +
			'<i class="fa fa-reply" aria-hidden="true"></i>' +
			'</a>' +
			'<a class = "action reply'+comment_id+'" onclick = "load_reply('+comment_id+')"> '+data.countReply+' replies</a>';

			$('.reply-hidden'+comment_id).append(show);
			$('.isReply'+comment_id).removeClass('hidden-decoration');
			$('.reply-span'+comment_id).empty();
			$('.reply-span'+comment_id).html('<a class = "action reply_now'+comment_id+'" onclick = "load_reply('+comment_id+')" style="font-size: 12px"> Reply </a>');
		}
	});
}

function load_more(control, music_id){
	$.ajax({
		type: "GET",
		data: {control: control, music_id: music_id},
		url: "comments/loadMore",
		dataType: 'json',
		success: function(data) {
			if(data.isMore == 0){
				$('.load-more').empty();
			}else{
				$('.load-more').empty();
				$('.load-more').append('<a class = "action more-comment" onclick = "load_more('+(parseInt(control) + 1)+', '+music_id+')">Xem thêm</a>');

				comment = data.comments;

				html = " ";
				i = 0;
				index = 0;
				j = 0;
				for(x in comment){
					if(i == data.number){
						break;
					}

					if(index > data.count){
						if(comment[x]['parent_id'] == 0){
							html += '<div class="comments'+data.comment_id[j]+'">' +
							'<div style="margin-bottom: 13px">' +
							'<img class="avatar-user" src="upload/user/'+data.urlanh[j]+'" width="30px" />' +
							'<p style="margin-bottom: 0px"><b>'+data.usernameReply[j]+'</b>' +
							'<span class="span'+data.comment_id[j]+'" style="margin-left: 10px">'+data.comment[j]+'</span>' +
							'<span class="edit-div'+data.comment_id[j]+'"></span>' +
							'</p>' +
							'<span class="countIcon'+data.comment_id[j]+'">'+data.countLike[j]+'</span>';
							if(data.user_id != 0){
								html += '<span>' +
								'<ul class="fbicon contain-icon">' +
								'<li>';
								if(data.isLike[j] == 0){
									html += '<a class = "control'+data.comment_id[j]+'" onclick="dislike('+data.comment_id[j]+', '+data.user_id+')"><i class="fa fa-thumbs-o-up icon-like" aria-hidden="true"></i></a>';
								}else{
									if(data.test[j] == 1){
										html += '<a class = "control'+data.comment_id[j]+'" onclick="dislike('+data.comment_id[j]+', '+data.user_id+')"><i class="fa fa-thumbs-up icon-like" aria-hidden="true"></i></a>';
									}
									if(data.test[j] == 0){
										html += '<a class = "control'+data.comment_id[j]+'" onclick="dislike('+data.comment_id[j]+', '+data.user_id+')"><img class="angry" src="pages/images/happy.png" /></a>';
									}
									if(data.test[j] == -1){
										html += '<a class = "control'+data.comment_id[j]+'" onclick="dislike('+data.comment_id[j]+', '+data.user_id+')"><img class="none" src="pages/images/wow.png" /></a>'
									}
								}

								html += '<ul class="show-icon">' +
								'<li ><a class="heart" onclick="like_comment('+data.comment_id[j]+', '+data.user_id+', 1)"><i class="fa fa-thumbs-up icon-like" aria-hidden="true"></i></a></li>' +
								'<li ><a class="angry" onclick="like_comment('+data.comment_id[j]+', '+data.user_id+', -1)"><img class="angry" src="pages/images/wow.png" /></a></li>' +
								'<li><a  onclick="like_comment('+data.comment_id[j]+', '+data.user_id+', 0)"><img class="none" src="pages/images/happy.png" /></a></li>' +
								'</ul>' +
								'</li>' +
								'</ul>' +
								'</span>';

								if(data.user_id == data.id_user[j]){
									html += '<a class="action" onclick="removeComment('+data.comment_id[j]+', '+music_id+')">Delete </a>';
								}

								html += '<span class="reply-span'+data.comment_id[j]+'">' +
								'<a class = "action reply'+data.comment_id[j]+'" onclick = "load_reply('+data.comment_id[j]+')" style="font-size: 12px">Reply </a>' +
								'</span>';

								if(data.user_id == data.id_user[j]){
									html += '<span class = "removeEdit'+data.comment_id[j]+'">' +
									'<a class=" action edit'+data.comment_id[j]+'" onclick="edit('+data.comment_id[j]+')" style="font-size: 12px">Edit</a>' +
									'</span>';
								}

							}else{
								html += '<a class = "control'+data.comment_id[j]+'" onclick="confirmLogin()"><i class="fa fa-thumbs-o-up icon-like" aria-hidden="true"></i></a>';
							}

							html += '<span class="dt"><i>'+data.created_at[j]+'</i></span>';

							if(data.countReply[j] != 0){
								html += '<div class = "isReply'+data.comment_id[j]+'" style = "color: blue">' +
											'<span class="reply-hidden'+data.comment_id[j]+'">' +
												'<a class = "action reply'+data.comment_id[j]+'" onclick = "load_reply('+data.comment_id[j]+')"><i class="fa fa-reply" aria-hidden="true"></i></a>' +
												'<a class = "action reply'+data.comment_id[j]+'" onclick = "load_reply('+data.comment_id[j]+')"> '+data.countReply[j]+' Replies</a>' +
											'</span>' +
										'</div>';
							}else{
								html += '<div class = "isReply'+data.comment_id[j]+'" style = "color: blue">' +
											'<span class="reply-hidden'+data.comment_id[j]+'"></span>' +
										'</div>';
							}

							html += '<div class = "loadReply loadMore'+data.comment_id[j]+'"></div>';
							html += '</div></div>';

							i += 1;
							j += 1;
						}
					}
				
					index += 1;
				}
			}
			$('.newComment').append(html);
		}
	});
}