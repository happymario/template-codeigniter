<?php

use Fabiang\Xmpp\Protocol\Message;
use Fabiang\Xmpp\Options;
use Fabiang\Xmpp\Client;
use Fabiang\Xmpp\Protocol\Roster;
use Fabiang\Xmpp\Protocol\Presence;

function send_push_openfire($server_addr, $domain, $room_name, $dev_type = 'android', $push_type = 0, $title = '', $content = '', $target_url = '', $data=null)
{
    if(TEST_LOCAL_MODE == true) {
        return false;
    }

    $port = 5222;
    $id = null;
    try {
        $options = new Options("tcp://{$server_addr}:{$port}");

        $options->setAuthenticated(false)
            ->setUsername("admin")
            ->setPassword("root")
            ->setTimeout(1000)
            ->setPeerVerification(false);

        $client = new Client($options);
        // optional connect manually
        $client->connect();
        // fetch roster list; users and their groups
        $client->send(new Roster);
        // set status to online
        $client->send(new Presence);

        //        $message = new Message;
        //        $message->setMessage($title."\n".$content)->setTo('tester1@happymario');
        //        $client->send($message);

        $channel = new Presence;
        $channel->setTo("{$room_name}@conference.{$domain}")
            ->setNickName('admin');
        $client->send($channel);

        $fields['extras'] = [
            'type' => $push_type,
            'message' => $content,
            'title' => $title,
            'targetUrl' => $target_url,
            'dev_type' => $dev_type
        ];
        if ($data != null) {
            $fields['extras'] = array_merge($fields['data'], $data);
        }

        $message = new Message;
        $message->setMessage(json_encode($fields))
            ->setTo("{$room_name}@conference.{$domain}")
            ->setType(Message::TYPE_GROUPCHAT);
        $client->send($message);

        return json_encode([
            "id" => $channel
        ]);
    }
    catch (Exception $e) {
        echo 'Message: ' .$e->getMessage();
    }
}