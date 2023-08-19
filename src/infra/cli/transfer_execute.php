<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';
require_once 'src/config.php';

use src\app\command\transfer\TransferCommand;
use src\infra\cli\TransferControllerCli;

// input example (all inline):
//  php src/infra/cli/transfer_execute.php
// --originAccountId=cc8b43ca-207f-4b73-be25-9b8c194ee5f8
// --destinationAccountId=ea2bcb8d-fd48-483f-8a15-763d40a0c360
// --amount=10
$input = getopt((string)null, ["originAccountId:", "destinationAccountId:", "amount:"]);
var_dump($input);
$handler = $container->get(TransferControllerCli::class);
$handler->execute($input['originAccountId'], $input['destinationAccountId'], $input['amount']);
