<?php

namespace Response\Response\Commands;

use Illuminate\Console\Command;

class ResponseCommand extends Command
{
    public $signature = 'response';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
