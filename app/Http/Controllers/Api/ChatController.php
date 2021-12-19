<?php

namespace App\Http\Controllers\Api;

use App\Events\MessageRead;
use App\Events\MessageSend;
use App\Http\Controllers\Controller;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function get_contacts($id)
    {
//        $messages = Message::where('from_id', $id)->orWhere('to_id', $id)->orderBy('id','desc')->get();
//        $data = [];
//        foreach ($messages as $message) {
//            if ($message->from_id != $id) {
//                $user = User::find($message->from_id);
//                $data[] = $user;
//            } else {
//                $user = User::find($message->to_id);
//                $data[] = $user;
//            }
//        }
        $contacts = User::find($id)->getContacts();

        $contacts = collect($contacts);

        $unreadIds = Message::select(\DB::raw('`from_id` as sender_id, count(`from_id`) as messages_count'))
            ->where('to_id',$id)
            ->where('seen',0)
            ->groupBy('from_id')
            ->get();

        $contacts = $contacts->map(function ($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();
            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;
            return $contact;
        });

        return response()->json($contacts);
    }

    public function get_conversation($userId, $myId)
    {
        $messages = Message::where([
            ['from_id', $userId],
            ['to_id', $myId]
        ])->orWhere([
            ['from_id', $myId],
            ['to_id', $userId]
        ])->get();
        foreach ($messages as $message) {
//            $message->created_at = $message->created_at->format("M d, Y h:i a");
            if ($message->to_id == $myId && $message->seen == 0) {
                $message->seen = 1;
                $message->save();
                broadcast(new MessageRead($message));
            }
        }
        return response()->json($messages);
    }

    public function save_message(Request $request)
    {
        $message = new Message();
        $message->from_id = $request->from_id;
        $message->to_id = $request->to_id;
        $message->message = $request->message;
        $message->seen = 0;
        $message->save();

        broadcast(new MessageSend($message));

        return response()->json($message);
    }

    public function get_new_messages($id) {
        $messages = Message::where([
            ['to_id',$id],
            ['seen',0]
        ])->count();
        return $messages;
    }

    public function mark_messages_as_read($userId, $myId) {
        $messages = Message::where([
            ['from_id', $userId],
            ['to_id', $myId]
        ])->orWhere([
            ['from_id', $myId],
            ['to_id', $userId]
        ])->get();
        foreach ($messages as $message) {
            if ($message->to_id == $myId) {
                $message->seen = 1;
                $message->save();
            }
        }
        return response()->json(1);
    }

}
