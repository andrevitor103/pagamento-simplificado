<?php

namespace src\app\command;

interface CommandHandler {
    public function execute(Command $command): void;
}
