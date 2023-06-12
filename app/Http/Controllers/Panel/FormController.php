<?php

namespace App\Http\Controllers\Panel;

use App\Events\ActivityLog;
use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\FormBuilder;
use App\Models\FormDropdown;
use App\Models\FormField;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FormController extends Controller
{
    //

    public function form_builder(){
        $breadcrumbs = [
            ['link' => url("/panel"), 'name' => 'Dashboard'],
            ['link' => url("/panel/form/builder"), 'name' => 'formbuilder'],
            ['name' => __('formbuilder')],
        ];
        return view('content.form.form-index',compact('breadcrumbs'));
    }
    public function form_builder_ajax(Request $request){
        $user_id = auth()->user()->id;
        $records =  FormBuilder::where('created_by', $user_id)->get();
        return DataTables::of($records)->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn =  
                       '<a href="'.route('show.form.field',['id'=>$row->id]). '" style="padding-left:10px;" class="link-info" data-bs-toggle="tooltip"  data-bs-placement="top" title="Form Fields"><i class="fa-sharp fa-solid fa-list"></i></a>'.
            '<a href="#" style="padding-left:10px;" class="link-warning"  data-bs-toggle="tooltip"  data-bs-placement="top" title="Link" onclick="copy_link('.$row->id.')"><i class="fa-solid fa-link"></i></a>'.
            '<a href="' . route('show.form', ['code' => $row->code]) . '" style="padding-left:10px;" class="link-primary"  data-bs-toggle="tooltip"
                       data-bs-placement="top" title="View" target="_blank"><i class="fa-solid fa-eye"></i></a>'.
            '<a href="#" style="padding-left:10px;" class="link-success"  data-bs-toggle="tooltip"
                       data-bs-placement="top" title="Edit" onclick="edit_data('.$row->id.')"><i class="fas fa-edit"></i></a>'.
                      '<a href="#" style="padding-left:10px;" class="link-danger"  data-bs-toggle="tooltip"
                       data-bs-placement="top" title="Delet" onclick="delete_data(' . $row->id . ')"><i class="fa-solid fa-trash"></i></a>'.
                       '<input type="hidden" id="form'.$row->id.'" value="'.asset('form/'.$row->code).'">';
                return $btn;
            })
            ->addColumn('status', function ($row) {
                if($row->is_active == '1'){
                    $btn  = '<span class="badge bg-success">On</span>';
                }else{
                $btn  = '<span class="badge bg-danger">Of</span>';

                }
                 return $btn;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function form_builder_save(Request $request){
       try {
            $request->validate([
                'form_name' => 'required',
                'active' => 'required',
            ]);

            if($request->form_id != null){
                $form = FormBuilder::find($request->form_id);
            }else{
                $form = new FormBuilder();
                $form->code = uniqid() . time();
            }
            $code = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 20);
            $form->name = $request->form_name;
            $form->created_by = auth()->id();
            $form->is_active = $request->active;
            $form->is_lead_active ='1';
            $form->save();
            $actor = "";
            if (auth()->user()->is_admin == true) {
                $actor = 1;
            } else {
                $actor = 2;
            }
            $data = [
                'user_id' => auth()->id(),
                'name' => auth()->user()->first_name . " Create Form",
                'event_name' => "Create Form",
                'email' => auth()->user()->email,
                'description' => "Create Form Successfully",
                'actor' => $actor,
                'url' => url()->current(),
            ];
            event(new ActivityLog($data));

            $response = [
                'status' => 'success',
                'message' => 'Form Successfully Added',
            ];
            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'status' => 'error',
                'message' => $th->getMessage(),
            ];
            return response()->json($response);
        }
    }

    public function form_builder_edit(Request $request){
        try {
            $data = FormBuilder::where('id', $request->id)->first();
            $actor = "";
            if (auth()->user()->is_admin == true) {
                $actor = 1;
            } else {
                $actor = 2;
            }
            $data = [
                'user_id' => auth()->id(),
                'name' => auth()->user()->first_name . " Edit Form",
                'event_name' => "Edit Form",
                'email' => auth()->user()->email,
                'description' => "Edit Form Successfully",
                'actor' => $actor,
                'url' => url()->current(),
            ];
            event(new ActivityLog($data));

            $response = [
                'status' => 'success',
                'data' => $data,
            ];
            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'status' => 'error',
                'data' => $th->getMessage(),
            ];
            return response()->json($response);
        }
    }

    public function form_builder_delete(Request $request){
        try {
            $data = FormField::where('form_builder_id', $request->id)->delete();
            $data = FormBuilder::where('id', $request->id)->delete();
            $actor = "";
            if (auth()->user()->is_admin == true) {
                $actor = 1;
            } else {
                $actor = 2;
            }
            $data = [
                'user_id' => auth()->id(),
                'name' => auth()->user()->first_name . " Delete Form",
                'event_name' => "Delete Form",
                'email' => auth()->user()->email,
                'description' => "Delete Form Successfully",
                'actor' => $actor,
                'url' => url()->current(),
            ];
            event(new ActivityLog($data));

            $response = [
                'status' => 'success',
                'message' => "Form Successfully Delete",
            ];
            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'status' => 'error',
                'message' => $th->getMessage(),
            ];
            return response()->json($response);
        }
    }

    public function show_form_field($id){
       
        return view('content.form.show-form-field',compact('id'));
    }
     public function form_field_ajax(Request $request){
        $user_id = auth()->user()->id;
        $records =  FormField::where('created_by', $user_id)->where('form_builder_id',$request->form_id)->get();
        return DataTables::of($records)->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="#" style="padding-left:10px;" class="link-success"  data-bs-toggle="tooltip"
                       data-bs-placement="top" title="Edit" onclick="edit_model(' . $row->id . ')"><i class="fas fa-edit"></i></a>' .
            '<a href="#" style="padding-left:10px;" class="link-danger"  data-bs-toggle="tooltip"
                       data-bs-placement="top" title="Delet" onclick="delete_data('.$row->id.')"><i class="fa-solid fa-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
     }

     public function save_form_field(Request $request){
        
        try {
            $request->validate([
                'field_name' => 'required',
                'type' => 'required',
            ]);
           if($request->f_id !=null){
                $form_field = FormField::find($request->f_id);
                $messgae = 'Form Field Successfully Updated';
                $delete = FormDropdown::where('form_field_id',$request->f_id)->delete();

           }else{
               $form_field = new FormField();
               $form_field->form_builder_id = $request->form_id;
               $messgae = 'Form Field Successfully Added';
           }
            $form_field->name = $request->field_name;
            $form_field->created_by = auth()->id();
            $form_field->type = $request->type;
            $form_field->save();

            if(isset($request->dropdonwn[0])){
                for($i=1;$i<=count($request->dropdonwn);$i++){
                  $dropdown = new FormDropdown();
                  if($i==1){
                    $key = '1_on_1_training';
                  }elseif($i==2){
                        $key = 'consulting';
                  }elseif($i==3){
                        $key = 'connect_sofware';
                  }else{
                    $key = 'other';
                  }
                  $dropdown->key = $key;
                  $dropdown->value = $request->dropdonwn[$i-1];
                  $dropdown->form_field_id = $form_field->id;
                  $dropdown->save();
                }
            }

            $actor = "";
            if (auth()->user()->is_admin == true) {
                $actor = 1;
            } else {
                $actor = 2;
            }
            $data = [
                'user_id' => auth()->id(),
                'name' => auth()->user()->first_name . " Create Form Fields",
                'event_name' => "Create Form Fields",
                'email' => auth()->user()->email,
                'description' => "Create Form Fields Successfully",
                'actor' => $actor,
                'url' => url()->current(),
            ];
            event(new ActivityLog($data));

            $response = [
                'status' => 'success',
                'message' => $messgae,
            ];
            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'status' => 'error',
                'message' => $th->getMessage(),
            ];
            return response()->json($response);
        }
     }

     public function edit_form_field(Request $request){
        try {

          $data = FormField::where('id',$request->id)->first();
            $actor = "";
            if (auth()->user()->is_admin == true) {
                $actor = 1;
            } else {
                $actor = 2;
            }
            $data = [
                'user_id' => auth()->id(),
                'name' => auth()->user()->first_name . " Edit Form Fields",
                'event_name' => "Edit Form Fields",
                'email' => auth()->user()->email,
                'description' => "Edit Form Fields Successfully",
                'actor' => $actor,
                'url' => url()->current(),
            ];
            event(new ActivityLog($data));
          $response = [
            'status' => 'success',
            'data' => $data,
        ];
        return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'status' => 'error',
                'data' => $th->getMessage(),
            ];
            return response()->json($response);
        }
     }

     public function delete_form_field(Request $request){
        try {
            $delete = FormDropdown::where('form_field_id', $request->id)->delete();

            $data = FormField::where('id', $request->id)->delete();

            $actor = "";
            if (auth()->user()->is_admin == true) {
                $actor = 1;
            } else {
                $actor = 2;
            }
            $data = [
                'user_id' => auth()->id(),
                'name' => auth()->user()->first_name . " Delete Form Fields",
                'event_name' => "Delete Form Fields",
                'email' => auth()->user()->email,
                'description' => "Delete Form Fields Successfully",
                'actor' => $actor,
                'url' => url()->current(),
            ];
            event(new ActivityLog($data));

            $response = [
                'status' => 'success',
                'message' => 'Field Successfully Deleted',
            ];
            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'status' => 'error',
                'message' => $th->getMessage(),
            ];
            return response()->json($response);
        }
     }

     public function show_form($code){
           $data = FormBuilder::where('code',$code)->with('formfields')->first();
          if(!empty($data)){
              return view('content.form.form-builder',compact('data','code'));
          }
        
     }
}
