<?php

namespace App\Http\Controllers;
use App\{Module,Task};
use Illuminate\Http\Request;
use DataTables;
use DB;
use Storage;

class ModulesController extends Controller
{
    public function manageModules()
    {
        $modules = Module::where('parent_id', '=', 0)->get();
        $subModules = Module::pluck('name','id')->all();
        return view('ModuleTreeview',compact('modules','subModules'));
    }
    public function addModule(Request $request)
    {
        $this->validate($request, [
        		'name' => 'required',
        	]);
        $input = $request->all();
        $input['created_by'] = 1;
        $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];
       
        
        Module::create($input);
        return back()->with('success', 'New Category added successfully.');
    }
    public function addTestcase(Request $request)
    {
        $this->validate($request, [
        		'name' => 'required',
        		'summary' => 'required',
        	]);
        $input = $request->all();
        $input['created_by'] = 1;
        $input['module_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];        
     
        if (!empty($request->image)) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $file_name = date('YmdHis') .'.'. $extension;
            $path = 'images/task';
            $store = $request->file('image')->storeAs($path, $file_name);

            $input['file'] = $file_name;
        }
        Task::create($input);
        return back()->with('successTask', 'New Task added successfully.');
    }

    
    public function manageTask(Request $request)
    { 
        DB::enableQueryLog();

        $Task = Task::orderby('id','desc');
        if($request->module_id != 0){
            $module_ids =[];
           $module = Module::with('children')->where('parent_id', '=',$request->module_id)->get();  
           $module_ids[]=$request->module_id;
           foreach($module as $mod){
            $module_ids[]=$mod->id;
            if(count($mod->children) > 0){
                foreach($mod->children as $mods){
                    $module_ids[]=$mods->id;
                }
            }
            
           }

        //   $module_ids =  implode(',',$module_ids);    
          
           $Task->whereIn('module_id',$module_ids);
          
               
        }
        $Task->get();
        return Datatables::of($Task)->addIndexColumn()->addColumn('action', function($row){
            $btn = '<a href="javascript:void(0)" width="10px" class="edit btn btn-primary btn-sm">View</a>';
            $btn .= '<a href="javascript:void(0)" onclick="delete_task('.$row->id.')" class="delete btn btn-primary btn-sm">Delete</a>';
            $btn .= '<a href="'.Storage::url('app/public/images/skills/' . $row->file).'" class="btn btn-primary btn-sm">Download</a>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
      
    }

    public function destroy(Request $request)
        {
            return self::customDelete('\App\Task', $request->id);
        }
}
