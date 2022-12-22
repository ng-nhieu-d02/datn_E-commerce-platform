<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use App\Models\ChatRoom;
use App\Models\PermissionStore;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class chatController extends Controller
{
    public function __construct()
    {
        
    }
    public function user($store)
    {
        $room = ChatRoom::where('id_user', '=', Auth::user()->id)->where('id_store', '=', $store)->first();
        $list_room = ChatRoom::where('id_user', '=', Auth::user()->id)->orderBy('id', 'desc')->paginate(20);
        return view('home.pages.user_chat', [
            'room'  => $room,
            'id_store'     => $store,
            'list_room' => $list_room
        ]);
    }
    public function store($store, $user)
    {
        $permission = PermissionStore::where('id_store', $store)->first();
        if($permission->id_user != Auth::user()->id) {
            return redirect()->back()->with('error', 'Yêu cầu quyền truy cập');
        }
        $room = ChatRoom::where('id_user', '=', $user)->where('id_store', '=', $store)->first();
        $list_room = ChatRoom::where('id_store', '=', $store)->orderBy('id', 'desc')->paginate(20);
        return view('home.pages.store_chat', [
            'room'  => $room,
            'id_store'     => $store,
            'list_room' => $list_room
        ]);
    }
    public function send_chat(Request $request)
    {
        if($request->room == 'false') {
            $data = [
                'id_store'  => $request->id_store,
                'id_user'   => Auth::user()->id,
                'status'    => '0'
            ];
            $room = ChatRoom::create($data);
        } else {
            $room = ChatRoom::find($request->room);
        }
        if($request->type == 0) {
            if($room->id_user != Auth::user()->id) {
                return 'error';
            } else {
                $data_m = [
                    'id_room'   => $room->id,
                    'id_user'   => Auth::user()->id,
                    'type'  => '0',
                    'message'   => $request->message,
                    'status'    => '0'
                ];
                $chat = ChatMessage::create($data_m);
                $to = PermissionStore::where('id_store', $room->id_store)->first();
                $res = [
                    'chat'  => $chat,
                    'subject'  => [
                        'avatar'    => asset('upload/profile/avatar').'/'. $room->user->avatar,
                        'name'  => $room->user->name,
                        'id'    => $room->id_store
                    ],
                    'to'    => $to->id_user,
                    'subject_to' => [
                        'avatar'    => asset('upload/store/avatars').'/'. $room->store->avatar,
                        'name'  => $room->store->name
                    ]
                ];
                return json_encode($res);
            }
        } else {
            $permission = PermissionStore::where('id_store', $room->id_store)->first();
            if($permission->id_user != Auth::user()->id) {
                return 'error';
            } else {
                $data_m = [
                    'id_room'   => $room->id,
                    'id_user'   => Auth::user()->id,
                    'type'  => '1',
                    'message'   => $request->message,
                    'status'    => '0'
                ];
                $chat = ChatMessage::create($data_m);
                $to = $room->id_user;
                $res = [
                    'chat'  => $chat,
                    'subject'  => [
                        'avatar'    => asset('upload/store/avatars').'/'. $room->store->avatar,
                        'name'  => $room->store->name,
                        'id_store'    => $room->id_store,
                        'id_user'   => $room->id_user
                    ],
                    'to'    => $to,
                    'subject_to' => [
                        'avatar'    => asset('upload/profile/avatar').'/'. $room->user->avatar,
                        'name'  => $room->user->name
                    ]
                ];
                return json_encode($res);
            }
        }
    }
}
