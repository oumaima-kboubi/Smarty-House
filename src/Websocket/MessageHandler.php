<?php
namespace App\Websocket;

use App\Controller\FillTableController;
use Exception;
use Ratchet\ConnectionInterface;
use Ratchet\Wamp\WampServerInterface;
use Ratchet\MessageComponentInterface;
use SplObjectStorage;
use Symfony\Component\Console\Output\OutputInterface;
 
class MessageHandler implements MessageComponentInterface
{
    protected $output;
    protected $connections;

    public function __construct(OutputInterface $out)
    {
        $this->connections = new SplObjectStorage;
        $this->output = $out;
    }
 
    public function onOpen(ConnectionInterface $conn)
    {
        $this->connections->attach($conn);
        $this->output->writeln("ClientConnected");
    }
 
    public function onMessage(ConnectionInterface $from, $msg)
    {
        $decodedMsg = json_decode($msg);
        
        //$this->output->writeln("MessageRecieved");
        $url = "http://127.0.0.1:8000/websocket/actuator/$decodedMsg->id/$decodedMsg->date/$decodedMsg->value"; //prepaire a url to the symfony server
        dump($url);                                                   //for testing purposes
        $jsonResp = file_get_contents($url);                          //makes a request based on the url (controller returns a json file containing true or false)   
        $dec = json_decode($jsonResp);                                //decodes the server response containing                         //if request success > true
        if($dec->isRequestTreated == "true"){                                          
            foreach ($this->connections as $connection) {             //iterate through all connected (needs to change cuz you cant just send to everybody)
                if(1==1){                                             //need authentification to controle who gets sent to and who not
                    $connection->send($msg);
                }
            }
        }else{
            //$this->output->writeln("MessageRejected");
        }
        
    }
 
    public function onClose(ConnectionInterface $conn)
    {
        $this->connections->detach($conn);
    }
 
    public function onError(ConnectionInterface $conn, Exception $e)
    {
        $this->connections->detach($conn);
        $conn->close();
    }
}