<?php
use Carbon\Carbon;
class UserController extends BaseController {

    var $year;
    protected $ajax;
    public function __construct()
    {
        parent::__construct();
      
      
        $this->year = Session::get(' ');
    }

    public function index()
    {
        $filters = Input::get("filter", array());
        $sort_order=Input::get("sort_order",array());
       
        $data = \User::select('users.*')
                    
                    ->where("users.deleted","0")
                    ->orderBy('users.id','desc');
                    print_r($data->get());exit;
        if (!empty($filters) && is_array($filters)) {
            foreach ($filters as $column => $row) {
                if (!empty($column) && !empty($row["value"]) && is_array($row)) {
                    $operator = Config::get("srtpl.type", 1)[$row["type"]];
                    if($row["type"] == 7){
                        $data->where('user.'.$column, $operator, "%{$row["value"]}%");
                    }else{
                        $data->where('user.'.$column, $operator, $row["value"]);
                    }
                }
            }
        }
        if (!empty($sort_order) && is_array($sort_order)) {
            foreach ($sort_order as $column => $direction) {
                $data->orderBy($column, $direction);
            }
        }
        $ulist = $data->paginate(Config::get("srtpl.par_page", 10));
        $per_page = Config::get('srtpl.par_page', 10);
        $per_page = $per_page - 1;
        $i = (Input::get('page')) ? (Input::get("page") * Config::get("srtpl.par_page", 10)) - $per_page : 1;
        return View::make('user.index',compact('ulist'))->with('i',$i);

    }
    public function create()
	{
        return View::make('user.create');
	}
    public function store()
	{
		Input::merge(array_map('trim', Input::all()));
		$input=Input::all();
        $rules = array(
                   'id' => 'Required|not_in:0'
            );
        $v1 = Validator::make(Input::all(), $rules);
        if ($v1 -> fails())
        {
            $messages = $v1->messages();
            Session::flash('error_msg', 'Field is required.');
            return Redirect::route('user.create')->withInput()->withErrors($v1);;
        }
        else
        {
            $doj = date('Y-m-d',strtotime(Input::get('doj')));
            $dol = date('Y-m-d',strtotime(Input::get('dol')));
            $dj = Carbon::parse($doj);
            $dl = Carbon::parse($dol);
            $diff_d = $dj->diffInDays($dl);

            if (Input::hasFile('image'))
            {
                $file=Input::file("image");
                if ($file->isValid()) {
                    $destinationPath = Config::get('srtpl.F:\project\htdocs\springr_task\task\public\img'); // upload path
                    $extension = $file->getClientOriginalExtension();
                    // print_r($extension);exit;
                    if($extension != 'jpeg' && $extension != 'jpg' && $extension != 'png')
                    {
                        Session::flash('error_msg_custom', 'Employee Photo type must be jpeg OR jpg OR png');
                        return Redirect::route('user.create')->withInput();
                    }
                    $name = $file->getClientOriginalName();
                    // $fileName = Input::get('name').rand(11111,99999).'.'.$extension; // renameing image
                    $fileName = 'Emp_'.rand(111111,999999).'.'.$extension; // renameing image
                    $file->move($destinationPath, $fileName); // uploading file to given path
                }
            }
            else
            {
                $fileName = '';
            }
           
        	
            $userdata = array(
            	'name' => Input::get('name'),
            	'email' => Input::get('email'),
                'doj'     => date("Y-m-d", strtotime(Input::get('doj'))),
                'dol'     => date("Y-m-d", strtotime(Input::get('dol'))),
                'work' => Input::get('work'),
                'image' => $file_name,    

            );
            DB::table('users')->insert($userdata);
            Session::flash('success_msg', 'Record insert Successfully..!!');
            return Redirect::Route('user.index');
        }
	}
    public function show($id)
	{
		//
	}
    public function destroy($id)
	{
		\DB::table('users')->where('id','=',$id)->update(array('deleted'=>'1'));
            return Redirect::route('user.index')->with('success_msg', 'Record deleted successfully.');
	}

}


