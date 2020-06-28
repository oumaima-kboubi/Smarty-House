<?php
namespace App\Command;

use App\Websocket\MessageHandler;
use Ratchet\App;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use React\EventLoop\Factory;
use React\Socket\Server;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

class WebsocketServerCommand extends Command
{

    protected static $defaultName = "websocket:server:run";

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $port = 3001;
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new MessageHandler($output)
                    )
                ),
                $port
            );
        $output->writeln("Websocket Server Started in port " . $port);
        $server->run();
        return 0;
    }
}