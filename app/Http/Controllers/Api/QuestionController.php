<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Question;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class QuestionController extends Controller
{
    public $successStatus = 200;
    public function getQuestions(Request $request) 
    {    
        $data = new Question();
        $data = $data->getQuestionsPreSurvey();
        return response()->json(['questions'=>$data], $this->successStatus); 

    }
    public function getFirstAssetment(Request $request) 
    {    
        $data = new Question();
        $data = $data->getFirstAssetment();
        return response()->json(['questions'=>$data], $this->successStatus); 
        
    }
    public function PreMeetingInsert(Request $request)
    {
        $post = $request->all();
        $user_id = $request->input('user_id');
        $role = $request->input('role');
        $pre_meeting = $request->input('pre_meeting');
        $obj = new Question();
        $res = $obj->addPreMeeting($post);
        if($res){

                if($role==2 && $pre_meeting==0){

                            $res = DB::table('users')
                            ->where('id', $user_id)  // find your user by their email
                            ->limit(1)  // optional - to ensure only one record is updated.
                            ->update(array('pre_meeting' => '1')); 
                            if($res){
                                    return response()->json(['res'=>$res,'msg'=>'success'],200);    
                            }else{
                                return response()->json(['res'=>$res,'msg'=>'failed.'],200);    
                            }
                            
                }else{
                    return response()->json(['res'=>$res,'msg'=>'success'],200);   
                }
            

        }else{
            return response()->json(['res'=>$res,'msg'=>'failed'],200);    
        }
        // return response()->json(['res'=>$post,'msg'=>'success'],200);    

    }
    public function addFirstAssetment(Request $request)
    {
        $post = $request->all();
        $obj = new Question();
        $res = $obj->addFirstAssetment($post);
        if($res){
            return response()->json(['status'=>$res,'msg'=>'success'],200);    
        }else{
                return response()->json(['status'=>$res,'msg'=>'failed'],200);    
        }
        
    }
}
 