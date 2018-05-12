<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Likecmt;

class LikecmtController extends Controller
{
    public function likeComment(Request $request){
    	$comment_id = $request->comment_id;
    	$user_id = $request->user_id;
    	$control = $request->control;

    	$isFinish = 0;

    	$isLike = Likecmt::Where('comment_id', $comment_id)->Where('user_id', $user_id)->count();
    	$lastLike = Likecmt::orderBy('id', 'desc')->first();;

        $new_id = 1;
    	if($lastLike != null){
    		$new_id = $lastLike->id;
    	}

    	if($isLike == 0){
    		$Likecmt = new Likecmt;
    		$Likecmt->id = $new_id + 1;
    		$Likecmt->user_id = $user_id;
    		$Likecmt->comment_id = $comment_id;
    		$Likecmt->control = $control;

    		if($Likecmt->save()){
    			$isFinish = 1;
    		}
    	}else{
    		$Likecmt = Likecmt::where('comment_id', $comment_id)->where('user_id', $user_id)->first();
    		$Likecmt->control = $control;

    		if($Likecmt->save()){
    			$isFinish = 1;
    		}
    	}

    	$countLikecmt = 0;
    	if($isFinish == 1){
    		$countLike = Likecmt::where('comment_id', $comment_id)->count();
    	}

    	return json_encode(array('isFinish' => $isFinish, 'countLikecmt' => $countLike));
    }

    public function dislikeComment(Request $request){
        $comment_id = $request->comment_id;
        $user_id = $request->user_id;

        $isLike = Likecmt::Where('comment_id', $comment_id)->Where('user_id', $user_id)->count();
        $isFinish = 0;

        if($isLike == 0){
            $lastLike = Likecmt::orderBy('id', 'desc')->first();;

            $new_id = 1;
            if($lastLike != null){
                $new_id = $lastLike->id;
            }

            $Likecmt = new Likecmt;
            $Likecmt->id = $new_id + 1;
            $Likecmt->user_id = $user_id;
            $Likecmt->comment_id = $comment_id;
            $Likecmt->control = 1;

            if($Likecmt->save()){
                $isFinish = 1;
            }
        }else{
            $Likecmt = Likecmt::where('comment_id', $comment_id)->where('user_id', $user_id)->delete();
            
            if($Likecmt){
                $isFinish = 1;
            }
        }

        $countLikecmt = Likecmt::where('comment_id', $comment_id)->count();
        return json_encode(array('isFinish' => $isFinish, 'isLike' => $isLike, 'countLikecmt' => $countLikecmt));
    }
}
