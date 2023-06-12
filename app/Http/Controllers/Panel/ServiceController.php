<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ServiceController extends Controller
{
    //
    public function service_index(){
        $breadcrumbs = [
            ['link' => url("/panel"), 'name' => 'Dashboard'],
            ['link' => url("/panel/services"), 'name' => 'Services'],
            ['name' => __('services')],
        ];
        $modal = 'Add Service';
        return view('content.service.sevice-index',compact('breadcrumbs', 'modal'));
    }

    public function service_ajax(Request $request){

        $records = Service::get();
        return DataTables::of($records)->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="#" style="padding-left:10px;" class="link-success"  data-bs-toggle="tooltip"
                data-bs-placement="top" title="Edit" onclick="edit_data(' . $row->id . ')"><i class="fas fa-edit"></i></a>' .
                    '<a href="#" style="padding-left:10px;" class="link-danger"  data-bs-toggle="tooltip"
                data-bs-placement="top" title="Delet" onclick="delete_data(' . $row->id . ')"><i class="fa-solid fa-trash"></i></a>';
                return $btn;
            })
            ->addColumn('status', function ($row) {
                if ($row->status == '0') {
                    $status = '<span class="badge rounded-pill  badge-light-danger">Closed</span>';
                } else {
                    $status = '<span class="badge rounded-pill  badge-light-success">Active</span>';
                }
                return $status;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function service_create(Request $request){

        try {
            $request->validate([
                'name' => 'required',
                'price' => 'required',
            ]);
            if($request->service_id !=0){
                $service = Service::find($request->service_id);
                $message = "Service Successfully Updated!";
            }else{
                $service = new Service();
                $message = "Service Successfully added!";
            }
            $service->admin_id = auth()->id();
            $service->name = $request->name;
            $service->status = $request->status;
            $service->price = $request->price;
            $service->save();
            $response = [
                'status' => 'success',
                'message' => $message,
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

    public function service_edit(Request $request){
        try {
            $data = Service::find($request->id);
            return response()->json($data);

        } catch (\Throwable $th) {
            $response = [
                'status' => 'error',
                'message' => $th->getMessage(),
            ];
            return response()->json($response);
        }
    }

    public function service_delete(Request $request){
        try {
          $data = Service::where('id',$request->id)->delete();
           $response = [
                'status' => 'success',
                'message' => 'Service Successfully deleted'
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
}
