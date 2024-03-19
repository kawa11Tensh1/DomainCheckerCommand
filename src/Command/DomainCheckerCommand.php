<?php
// src/Command/DomainCheckerCommand.php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

// Подключение автозагрузчика Composer
require 'vendor/autoload.php'; 

#[AsCommand(
    name: 'domain:check',
    description: 'Check domain information',
)]

class DomainCheckerCommand extends Command
{
    protected static $defaultName = 'domain:check';

    protected function configure()
    {
        $this
            ->setDescription('Check domain information')
            ->setHelp('This command checks domain information like MX-records and PTR-records.')
            ->addArgument('domain', InputArgument::REQUIRED, 'The domain to check');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Получение адреса домена из входных данных
        $domain = $input->getArgument('domain'); // $domain = 'vl.ru';

        // Проверка существования домена и получение IP-адреса (DNS-запись типа "A")
        $ipAddress = gethostbyname($domain);

        if ($ipAddress == $domain) 
        {
            $output->writeln("Домена $domain не существует.");
        } 
        else 
        {
            $output->writeln("IP-адрес домена $domain: $ipAddress");

            // Получение MX-записей
            $mxRecords = dns_get_record($domain, DNS_MX);
            foreach ($mxRecords as $mxRecord) 
            {
                $mailServer = $mxRecord['target'];
                // Получение IP-адреса почтового сервера
                $mailServerIp = gethostbyname($mailServer);
                // Запрос PTR-записи для IP-адреса почтового сервера
                $ptrRecord = gethostbyaddr($mailServerIp);
                $output->writeln("Почтовый сервер: $mailServer, IP-адрес: $mailServerIp, PTR-запись: $ptrRecord");
            }
        }

        return Command::SUCCESS;
    }
}
