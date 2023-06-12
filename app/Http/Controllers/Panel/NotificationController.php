<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\UserNotifiction;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class NotificationController extends Controller
{
    //

    public function index(){
        $breadcrumbs = [
            ['link' => url("/panel"), 'name' => 'Dashboard'],
            ['link' => url("/panel/users/"), 'name' => 'notification'],
            ['name' => __('notification')],
        ];
      

        return view('content.notification.notificaiton',compact('breadcrumbs'));
    }

    public function ajax(Request $request){

        $records = auth()->user()->user_notifications;
            return DataTables::of($records)->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="#" style="padding-left:10px;" class="link-danger"  data-bs-toggle="tooltip"
                data-bs-placement="top" title="Delet" onclick="delete_data(' . $row->id . ')"><i class="fa-solid fa-trash"></i></a>';
                return $btn;
            })
            ->addColumn('status', function ($row) {
            $status = '';
            if($row->status == '1'){
                $status =
                '<div class="form-check form-switch form-check-success">
                    <input type="checkbox" class="form-check-input get_status"
                        id="status_632d1c4bc458f" data-id="632d1c4bc458f"
                        name="status" value="1" checked onclick="status_change('.$row->id.')">
                </div>';
            }else{
                $status =
                '<div class="form-check form-switch form-check-success">
                    <input type="checkbox" class="form-check-input get_status"
                        id="status_632d1c4bc458f" data-id="632d1c4bc458f"
                        name="status" value="0"  onclick="status_change(' . $row->id . ')">
                </div>';
            }
                return $status;
            })
            ->rawColumns(['action', 'status',])
            ->make(true);

    }
    public function status(Request $request){
        try {

            $data = UserNotifiction::find($request->id);
            if($data->status == '0'){
                $data->status = '1';
            }else{
                $data->status = '0';
            }
            $data->save();

            $response = [
                'status' => 'success',
                'message' => 'Notification read status was successfully changed',
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
    public function delete(Request $request){
        try {

            $data = UserNotifiction::find($request->id);
            Notification::where('id',$data->notification_id)->delete();
            $response = [
                'status' => 'success',
                'message' => 'Notification Successfully Deleted',
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
