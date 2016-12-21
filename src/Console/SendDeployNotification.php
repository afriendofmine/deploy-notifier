<?php

namespace Afom\DeployNotifier\Console;

use Afom\DeployNotifier\DeployNotifierInterface;
use Afom\DeployNotifier\Message;
use Illuminate\Console\Command;

class SendDeployNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:deploy:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send deploy notification';

    /** @var DeployNotifierInterface */
    private $deployNotifier;

    /**
     * Create a new command instance.
     *
     * @param DeployNotifierInterface $deployNotifier
     */
    public function __construct(DeployNotifierInterface $deployNotifier)
    {
        parent::__construct();

        $this->deployNotifier = $deployNotifier;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $message = new Message(config('deploy-notifier.settings.sender'));
        $message->setBody(sprintf('<b>%s</b> Has been deployed to <b>%s</b>', config('deploy-notifier.settings.sender'), config('deploy-notifier.settings.environment')));
        $message->setHtml(true);
        $message->setColor($message->getColor());

        try {
            $this->deployNotifier->sendNotification($message);
        } catch (\Exception $exception) {
            $this->info('Something went wrong. Deploy notification has NOT been sent!');
        }
    }
}
