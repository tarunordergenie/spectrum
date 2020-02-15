<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $successStatus = 200;
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request) {    
        $validator = Validator::make($request->all(), 
                     [ 
                     'name' => 'required',
                     'email' => 'required|email',
                     'password' => 'required',  
                    ]);   
        // if ($validator->fails()) {          
        //     return response()->json(['msg'=>'Please fill all fields.','status'=>'failed'], 200);                        
        // }

        $email = $request->email;
        $emailcheck = DB::table('users')->where('email',$email)->count();
        if($emailcheck > 0)
        {
            return response()->json(['msg'=>'Email already exist','status'=>false], $this->successStatus); 
        }
        else
        {
            $input = $request->all();  
            $input['password'] = bcrypt($input['password']);
            $input['api_token'] = Hash::make($input['password']);
            $user = User::create($input); 
            $success['token'] =  $input['api_token'];
            return response()->json(['result'=>$user,'msg'=>'User added successfully','status'=>true], $this->successStatus); 
        }
        
    }
       

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function login(Request $request)
    {
            $credentials = $request->only('email','password');
            if(Auth::attempt($credentials)){
                $token = Str::random(80);
                Auth::user()->api_token=$token;
                Auth::user()->save();    
                // $id = Auth::id();
                $user = Auth::user();
                return response()->json(['status'=>true,'token'=>$token,'user'=>$user],200);    
            }
            else{
                return response()->json(['status'=>false],403);
            }

    }
    public function getUsers(Request $request)
    {
        // $user = User::all(); 
        $post = $request->all();
        $user_id = $post['user_id'];
        $role = $post['role'];

        // if($user_id=='' || $role==''){
        //     $users = DB::select("SELECT * FROM users LEFT JOIN city_m ON(province_m.city=users.province) LEFT JOIN city_m ON(city_m.City_ID=users.city) WHERE role!='admin'  ");
        //     // $users = DB::select("SELECT * FROM users LEFT JOIN city_m ON(province_m.city=users.province) LEFT JOIN city_m ON(city_m.City_ID=users.city) WHERE languagee!='adminlanguage  ");


        // }else{
        //     $users = DB::select("SELECT * FROM users LEFT JOIN province_m ON(province_m.Province_ID=users.province) LEFT JOIN city_m ON(city_m.City_ID=users.city) WHERE role='$role' and user_id='$user_id' ");

        // }    
         
        if($role=='1'){
            $users = DB::select("SELECT * FROM users LEFT JOIN province_m ON(province_m.Province_ID=users.province) LEFT JOIN city_m ON(city_m.City_ID=users.city) WHERE  user_id='$user_id' ");
        }
        return response()->json(['result'=>$users,'msg'=>'successfull'], $this->successStatus); 


    }
    public function getPatients(Request $request)
    {   
            $data = $request->all();
            $user_id=$data['id'];
            $role=$data['role'];
            if($role=='1'){
                
                $patients = DB::select("SELECT `u`.`name` As `doctor`,`u`.`role`,`p`.* FROM `users` AS `u` INNER JOIN `patients` As `p` ON(`p`.`doctor_id`=`u`.`id`)  WHERE `u`.`user_id` ='$user_id'");

            }else{
                $patients = DB::select("SELECT * FROM patients WHERE doctor_id = '$user_id'");
            }
            return response()->json(['patients'=>$patients,'msg'=>'successfull'], $this->successStatus); 
    }

    public function getPatientsSearch(Request $request)
    {   
            $data = $request->all();
            $user_id=$data['id'];
            $role=$data['role'];
            $txt=$data['txt'];
            if($txt==''){
                if($role=='1'){
                    $patients = DB::select("SELECT `u`.`name` As `doctor`,`u`.`role`,`p`.* FROM `users` AS `u` INNER JOIN `patients` As `p` ON(`p`.`doctor_id`=`u`.`id`)  WHERE `u`.`user_id` ='$user_id'");
                }else{
                    $patients = DB::select("SELECT * FROM patients WHERE doctor_id = '$user_id'");
                }
                
            }else{
                if($role=='1'){
                    $patients = DB::select("SELECT `u`.`name` As `doctor`,`u`.`role`,`p`.* FROM `users` AS `u` INNER JOIN `patients` As `p` ON(`p`.`doctor_id`=`u`.`id`)  WHERE `u`.`user_id` ='$user_id'");
                }else{
                    $patients = DB::select("SELECT * FROM patients WHERE doctor_id = '$user_id' and (id like '%".$txt."%' || initials like '%".$txt."%') ");
                }
            }
            
            return response()->json(['patients'=>$patients,'msg'=>'successfull'], $this->successStatus); 
    }
    
    public function getProvince(){
        $province = DB::select("SELECT * FROM `province_m` WHERE Country_ID = 1");
        return response()->json(['province'=>$province,'msg'=>'successfull'], $this->successStatus); 
    }
    
    public function getCity(Request $request ){
        
        $province_id = $request->all();
        $province_id=$province_id['province_id'];
        $city = DB::select("SELECT * FROM `city_m` WHERE Province_ID = '$province_id'");
        return response()->json(['city'=>$city,'msg'=>'successfull'], $this->successStatus); 

    }
    public function getDoctorEditData(Request $request)
    {
            $data= $request->all();
            $doc_id = $data['id'];
            $res = DB::select("SELECT * FROM `users` WHERE id = '$doc_id'");
            return response()->json(['user'=>$res[0],'msg'=>'successfull'], $this->successStatus); 

    }

    public function updateDoctor(Request $request){
        
        $data= $request->all();
        $data = $data['data'];
        $row = array(
                        'name'=>$data['name'],
                            'province'=>$data['province'],
                        'city'=>$data['city'],
                        'language'=>$data['language'],
                        'role'=>$data['role'],
                        
        );

        if(trim($data['password'])!=''){
            $row['password'] = bcrypt($data['password']);
            $row['api_token'] = Hash::make($data['password']);
        }      
        

        $res=DB::table('users')
                    ->where('id', $data['id'])
                        ->update($row);     
        if($res){
            return response()->json(['res'=>$res,'msg'=>'successfull','row'=>$row], $this->successStatus); 
        }else{
            return response()->json(['res'=>$res,'msg'=>'failed','row'=>$row], $this->successStatus); 
        }
        
    }

    public function updatePatientfollowup(Request $request){    
        $data= $request->all();
        $id = $data['id'];
        $date = $data['date'];

        $res=DB::table('patients')->where('id',$id)->update(['next_assessment_date'=>  $date]);     
        if($res){
            return response()->json(['res'=>$res,'msg'=>'successfull'], $this->successStatus); 
        }else{
            return response()->json(['res'=>$data,'msg'=>'failed'], $this->successStatus); 
        }
        
    }
    public function getUserData(Request $request){
            $data= $request->all();
            $id = $data['user_id'];
            $res = DB::select("SELECT * FROM `users` WHERE `id` = '$id'");
            return response()->json(['res'=>$res,'msg'=>'successfull'], $this->successStatus); 

    }

    public function fetchDoctorDetailsForClient(Request $request)
    {
        $data= $request->all();
        $id = $data['id'];
        $type = $data['type'];
        $sql="SELECT id as doc_id,name,email,IF(role=2,'Doctor','Demo') as role,pre_meeting,(SELECT DATE_FORMAT(created_on,'%Y-%m-%d') FROM answers WHERE doctor_id=doc_id limit 0,1 ) AS preDate,post_meeting,(select count(*) from patients where doctor_id=doc_id) as 'count1',(select count(*) from patients where doctor_id=doc_id and followup_type >=2) as 'count2' ,(select count(*) from patients where doctor_id=doc_id and followup_type =3) as 'count3',Province_Name,City_Name
            FROM users 
                LEFT JOIN province_m ON(province_m.Province_ID = users.province)
                LEFT JOIN city_m ON(city_m.City_ID = users.city)
            WHERE user_id = '$id' and role!='1'";
        if($type!='all'){
            $sql.=" and role!='3' ";
        }   
        $res = DB::select($sql);
        return response()->json(['res'=>$res,'msg'=>'successfull'], $this->successStatus); 
    }
    public function fetchDoctorDetailsForClientSearch(Request $request)
    {
        
        $data= $request->all();
        $id = $data['id'];
        $type = $data['type'];
        $txt = $data['txt'];
        
        $sql="SELECT id as doc_id,name,email,
                        IF(role=2,'Doctor','Demo') as role,
                        pre_meeting,(SELECT DATE_FORMAT(created_on,'%Y-%m-%d') FROM answers WHERE doctor_id=doc_id limit 0,1 ) AS preDate,post_meeting,(select count(*) from patients where doctor_id=doc_id) as 'count1',(select count(*) from patients where doctor_id=doc_id and followup_type >=2) as 'count2' ,(select count(*) from patients where doctor_id=doc_id and followup_type =3) as 'count3',Province_Name,City_Name
                FROM users 
                        LEFT JOIN province_m ON(province_m.Province_ID = users.province)
                        LEFT JOIN city_m ON(city_m.City_ID = users.city)
                WHERE user_id = '$id' and role!='1' and (name like '%".$txt."%' || email like '%".$txt."%' || Province_Name like '%".$txt."%' || City_Name like '%".$txt."%' ) ";

        if($type!='all'){
            $sql.="and role!='3'";
        }
        $res = DB::select($sql);
        return response()->json(['res'=>$res,'msg'=>'successfull'], $this->successStatus);
    }
    

}
