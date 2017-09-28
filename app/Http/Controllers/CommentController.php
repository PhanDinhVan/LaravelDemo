<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TinTuc;
use App\Comment;

class CommentController extends Controller
{

    public function getDelete($idComment,$idTinTuc){
    	$comment = Comment::find($idComment);
        $comment->delete();

        return redirect('admin/tintuc/edit/'.$idTinTuc)->with('thongbao','Bạn đã xóa thành công!');
    }
}
