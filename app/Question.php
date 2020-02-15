<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Question extends Model
{   
    protected $guarded = [];

    // addFirstAssetment

    public function addPreMeeting($data)
    {   
        $answer_array = array(
                    'doctor_id' => $data['user_id'],
                    'patient_initial' => '0',
                    'survey_type_id'=> 1,
                    'answer' => json_encode($data['answer']),
                    'patient_id'=>'0',
                );
        $res = DB::table('answers')->insert($answer_array);
        return $res;
    }

    public function getQuestionsPreSurvey() 
    {    
        $questions = DB::table('questions')->where('survey_type_id', '1')->orderBy('position')->get();
        $questions = json_decode(json_encode($questions), true);
        foreach($questions AS $key => $value){
                $question_id = $value['id'];
                $options = DB::table('options')->where('question_id', $question_id)->orderBy('position')->get();
                $options = json_decode(json_encode($options), true);
                $questions[$key]['options'] = $options;
        }
        return $questions;
    }
    public  function getFirstAssetment()
    {
        $questions = DB::table('questions')->where([['survey_type_id','=','2'],['parent_question_id','=','0']])->limit(15)->orderBy('position')->get();
        

        $questions = json_decode(json_encode($questions), true);
        foreach($questions AS $key => $question){
                    $question_id = $question['id'];
                    $options = DB::table('options')
                    ->where('question_id', $question_id)
                    ->orderBy('position')
                    ->get();
                    $options = json_decode(json_encode($options), true);
                    $questions[$key]['options'] = $options;

        }
        foreach($questions AS $key => $question){
                $question_id = $question['id'];
                $subquestions = DB::table('questions')->where([['survey_type_id','=','2'],['parent_question_id','=',$question_id]])->orderBy('position')->get();
                $subquestions = json_decode(json_encode($subquestions), true);
                $questions[$key]['subQuestions'] = $subquestions;

        }    
        foreach($questions AS $key => $question){
                $subquestions =  $question['subQuestions'];
                foreach($subquestions AS $key1 => $subquestion){
                    $subquestion_id = $subquestion['id'];
                    $options = DB::table('options')->where('question_id', $subquestion_id)->orderBy('position')->get();
                    $options = json_decode(json_encode($options), true);
                    $subquestions[$key1]['options'] = $options;
                    $questions[$key]['subQuestions'][$key1]['options'] = $options;
                }
        }
        return $questions;
    }
    public function addFirstAssetment($data)
    {
        $array = array(
                        'doctor_id' => $data['user_id'],
                        'initials' => $data['patient_initial'],
                        'assessment_date' => $data['assessment_date'],
                        'next_assessment_date' => $data['next_assesment'],
                        'followup_type' => 1
                      );   
        $res = DB::table('patients')->insert($array);
        $patient_id = DB::getPdo()->lastInsertId();
        $answer_array = array(
                                'doctor_id' => $data['user_id'],
                                'patient_initial' => $data['patient_initial'],
                                'survey_type_id'=> 2,
                                'answer' => json_encode($data['answer']),
                                'patient_id'=>$patient_id,
                            );
        $res = DB::table('answers')->insert($answer_array);
        return $res;
    }
}
