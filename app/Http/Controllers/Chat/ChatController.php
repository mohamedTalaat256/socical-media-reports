<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Models\Complain;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function getComplainMessages(Request $request)
    {
        $messages = Message::where('complain_id', $request->complain_id)->get();
        $complain = Complain::where('id', $request->complain_id)->get()->first();


        return json_encode(
            [
                'messages'=> $messages,
                'complain'=> $complain,
            ]
            );
    }

    public function sendMessageFromAdmin(Request $request)
    {

        $data = array();

        $related_to_id = Complain::where('id', $request->complain_id)->first()->related_to_id;

        $data['sender_is_admin'] = 1;
        $data['complain_id'] = $request->complain_id;
        $data['related_to_id'] = $related_to_id;
        $data['body'] = $request->body;
        $data['send_status'] = 1;
        $data['recieve_status'] = 0;
        $data['seen_status'] = 0;
        $data['is_updated_to_seen_on_sender'] = 0;

        $inserted_message_id = Message::insertGetId($data);

        $message = Message::where('id', $inserted_message_id)->first(); //last_message
       return json_encode($message);
    }

    public function sendMessageFromOrganization(Request $request)
    {


        $data = array();

        $related_to_id = Complain::where('id', $request->complain_id)->first()->related_to_id;

        $data['sender_is_admin'] = 0;
        $data['complain_id'] = $request->complain_id;
        $data['related_to_id'] = $related_to_id;
        $data['body'] = $request->body;
        $data['send_status'] = 1;
        $data['recieve_status'] = 0;
        $data['seen_status'] = 0;
        $data['is_updated_to_seen_on_sender'] = 0;

        $inserted_message_id = Message::insertGetId($data);

        $messages = Message::where('id', $inserted_message_id)->first();

       return json_encode($messages);
    }

    public function getUnseenMessagesCount()
    {
        $messages = Message::where('sender_is_admin', 0)
        ->where('seen_status', 0)
        ->get();

        return json_encode($messages->count());
    }

    public function getUnseenMessagesCountOrg()
    {
        $related_to_id = Auth::guard('organization')->user()->organization_id;
        $messages = Message::where('sender_is_admin', 1)
        ->where('related_to_id', $related_to_id)
        ->where('seen_status', 0)
        ->get();

        return json_encode($messages->count());
    }

    public function getIncomingMessagesToAdmin()
    {
        $messages = Message::where('sender_is_admin', 0)
        ->where('seen_status', 0)
        ->get();

        return json_encode($messages);
    }
    public function getIncomingMessagesToOrg()
    {
        $messages = Message::where('sender_is_admin', 1)
        ->where('seen_status', 0)
        ->get();



        return json_encode($messages);
    }

    public function UpdateMessageStatusToSeen(Request $request)
    {
        Message::where('id', $request->id)->update([
            'seen_status' => 1
        ]);
        return json_encode('updated_to_seen');
    }

    public function getUpdatedSeenMessagesToAdmin()
    {
        $messages = Message::where('sender_is_admin', 1)
        ->where('seen_status', 1)
        ->where('is_updated_to_seen_on_sender', 0)
        ->select('id', 'seen_status')
        ->get();

        return json_encode($messages);
    }
    public function getUpdatedSeenMessagesToOrg()
    {
        $messages = Message::where('sender_is_admin', 0)
        ->where('seen_status', 1)
        ->where('is_updated_to_seen_on_sender', 0)
        ->select('id', 'seen_status')
        ->get();

        return json_encode($messages);
    }

    public function updateToSeenOnSender(Request $request)
    {
        Message::where('id', $request->id)->update([
            'is_updated_to_seen_on_sender' => 1
        ]);

        return json_encode('ok');
    }
}
