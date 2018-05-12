<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Comments;
use App\User;
use App\Likecmt;

class CommentsController extends Controller
{
    public function addComment(Request $request){
        $Comment = new Comments;
        $comment = $request->comment;
        $music_id = $request->music_id;

        $user_id = Auth::user()->id;

        $comment_id = Comments::orderBy('id', 'desc')->first();
        if($comment_id != null){
            $Comment->id = $comment_id->id + 1;   
        }else{
            $Comment->id = 1;
        }
        
        $Comment->user_id = $user_id;
        $Comment->parent_id = 0;
        $Comment->music_id = $music_id;
        $Comment->comment = $comment;

        if($Comment->save()){
            if($comment_id == null){
                $new_comment = Comments::find(1);
            }else{
                $new_comment = Comments::find($comment_id->id + 1);
            }     

            $create_at = date('d-m-Y H:i:s', strtotime($new_comment->created_at));
            $user = User::find($new_comment->user_id);

            return json_encode(array('comment' => $comment, 'comment_id' => $new_comment->id, 'username' => $user->name, 'user_id' => $user_id, 'created_at' => $create_at, 'control' => 1, 'urlanh' => $user->urlanh));
        }

    	return json_encode(array('control' => 0));
    }

    public function removeComment(Request $request){
        $comment_id = $request->comment_id;
        $music_id = $request->user_id;

        //delete all like comment
        $Likecmt = Likecmt::where('comment_id', $comment_id)->delete();

        //delete all reply
        $Reply = Comments::where('parent_id', $comment_id);

        foreach ($Reply as $row) {
            //delete all like reply
            $LikeReply = Likecmt::where('comment_id', $row->id)->delete();
        }

        Comments::where('parent_id', $comment_id)->delete();
        //delete comment
        Comments::find($comment_id)->delete();
    }

    public function edit(Request $request){
        $comment_id = $request->comment_id;

        $Comment = Comments::find($comment_id);

        return json_encode(array('comment' => $Comment->comment));
    }

    public function editSave(Request $request){
        $comment_id = $request->comment_id;
        $comment = $request->comment;

        $Comment = Comments::find($comment_id);
        $Comment->comment = $comment;

        $isFinish = 0;
        if($Comment->save()){
            $isFinish = 1;
        }

        return json_encode(array('isFinish' => $isFinish, 'comment' => $comment));
    }

    public function loadReply(Request $request){
        $comment_id = $request->comment_id;

        $username = "";
        if(Auth::check()){
        	$user_id = Auth::user()->id;

        	$User = User::find($user_id);

        	$username = $User->name;
        }else{
			$user_id = 0;
        }
        
        

        $Replies = Comments::where('parent_id', $comment_id)->get();

        $i = 0;
        $countLike[0] = 0;
        $isLike[0] = 0;
        $control[0] = 0;
        $usernameReply[0] = "";
        $urlanh[0] = "";

        $created_at[0] = "";

        foreach ($Replies as $item) {
            $countLike[$i] = Likecmt::where('comment_id', $item->id)->count();

            $control[$i] = -2;
            if(Auth::check()){
                $isLike[$i] = Likecmt::where('comment_id', $comment_id)->where('user_id', $user_id)->count();
                if($isLike[$i] != 0){
                    $Control = Likecmt::where('user_id', $user_id)->where('comment_id', $comment_id)->first();
                    $control[$i] = $Control->control;
                }
            }

            $UserReply = User::where('id', $item->user_id)->first();
            $usernameReply[$i] = $UserReply->name;
            $urlanh[$i] = $UserReply->urlanh;

            $created_at[$i] = date('d-m-Y H:i:s', strtotime($item->created_at));

            $i += 1;
        }

        $CountReply = Comments::where('parent_id', $comment_id)->count();

        return json_encode(array('username' => $username, 'Replies' => $Replies, 'countLike' => $countLike, 'isLike' => $isLike, 'control' => $control, 'usernameReply' => $usernameReply, 'created_at' => $created_at, 'user_id' => $user_id, 'countReply' => $CountReply, 'urlanh' => $urlanh));
    }

    public function removeReply(Request $request){
        $comment_id = $request->comment_id;

        $countLike = Likecmt::where('comment_id', $comment_id)->count();

        $Comment = Comments::find($comment_id);
        $parent_id = $Comment->parent_id;
        $CountReply = Comments::where('parent_id', $parent_id)->count();

        $isFinish = 0;
        if($countLike > 0){
            //Delete all like
            if(Likecmt::where('comment_id', $comment_id)->delete()){
                //Delete reply
                if(Comments::where('id', $comment_id)->delete()){
                    $isFinish = 1;
                    $CountReply = 1;
                }
            }
        }else{
            if(Comments::where('id', $comment_id)->delete()){
                $isFinish = 1;
                $CountReply -= 1;
            }
        }

        // print_r(array('isFinish' => $isFinish, 'countReply' => $CountReply, 'parent_id' => $parent_id));

        // die();
        return json_encode(array('isFinish' => $isFinish, 'countReply' => $CountReply, 'parent_id' => $parent_id));
    }

    public function reply(Request $request){
        $comment = $request->comment;
        $parent_id = $request->comment_id;

        //check session user
        if(Auth::check()){
        	$user_id = Auth::user()->id;
        }else{
        	$user_id = 0;
        }

        $User = User::find($user_id);
        $username = $User->name;
        $urlanh = $User->urlanh;

        $Parent = Comments::find($parent_id);
        $music_id = $Parent->music_id;

        $Comment = Comments::orderBy('id', 'desc')->first();
        $comment_id = $Comment->id + 1;

        $NewComment = new Comments;

        $NewComment->id = $comment_id;
        $NewComment->parent_id = $parent_id;
        $NewComment->user_id = $user_id;
        $NewComment->comment = $comment;
        $NewComment->music_id = $music_id;

        $isFinish = 0;
        
        $fomatCreated_at = "";
        if($NewComment->save()){
            $isFinish = 1;

            $LastComment = Comments::find($comment_id);
            $create_at = date('d-m-Y H:i:s', strtotime($LastComment->created_at));
        }

        $CountReply = Comments::where('parent_id', $parent_id)->count();

        return json_encode(array('isFinish' => $isFinish, 'comment_id' => $comment_id, 'user_id' => $user_id, 'username' => $username, 'created_at' => $create_at, 'comment' => $comment, 'countReply' => $CountReply, 'urlanh' => $urlanh));
    }	

    public function hiddenReply(Request $request){
        $comment_id = $request->comment_id;

        $CountReply = Comments::where('parent_id', $comment_id)->count();

        return json_encode(array('countReply' => $CountReply));
    }
}
