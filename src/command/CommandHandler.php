<?php

namespace src\command;

interface CommandHandler {
    public function execute(Command $command): void;
}
