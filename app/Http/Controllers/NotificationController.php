<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
class NotificationController extends Controller
{
    public function index(){
        return view('backend.notification.index');
    }
    public function show(Request $request){
        $notification=Auth()->user()->notifications()->where('id',$request->id)->first();
        if($notification){
            $notification->markAsRead();
            return redirect($notification->data['actionURL']);
        }
    }
    public function delete($id){
        $notification=Notification::find($id);
        if($notification){
            $status=$notification->delete();
            if($status){
                request()->session()->flash('success','Notificacion eliminada con exito');
                return back();
            }
            else{
                request()->session()->flash('error','Error, intente nuevamente');
                return back();
            }
        }
        else{
            request()->session()->flash('error','Notificacion no encontrada');
            return back();
        }
    }
}
