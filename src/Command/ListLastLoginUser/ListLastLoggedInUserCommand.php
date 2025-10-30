<?php

namespace App\Command\ListLastLoginUser;

use App\Repository\ShopUserRepositoryInterface;
use DateTime;
use DateTimeZone;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name: 'app:list-last-logged-in-user',
            description: 'List users that have not logged in since X months.',
            help: 'This command allows you to list all users that have not been logged in since X months. 
                By default, it retrieves inactive users since 1 month.
                This command accepts a number of month as optional argument')]
class ListLastLoggedInUserCommand extends Command
{
    private ShopUserRepositoryInterface $userRepository;

    public function __construct(
        ShopUserRepositoryInterface $userRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
    }
    protected function configure()
    {
        $this->addArgument(
            'months',
            InputArgument::OPTIONAL,
            'The number of months to check inactive users (default: 1)',
            1
        );
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $months = (int) $input->getArgument('months');
        
        if ($months <= 0 || !is_int($months)) {
            $io->error('Months must be a positive integer');
            return Command::FAILURE;
        }

        try {
        
            $now = new DateTime('now', new DateTimeZone('UTC'));
            $since = $this->subtractMonthsNoOverflow($now, $months);

            $io->writeln(sprintf(
                'Listing users inactive since %s (UTC)',
                $since->format('Y-m-d H:i:s')
            ));

            $inactiveUsers = $this->userRepository->findInactiveUserSinceDate($since);

            if (!$inactiveUsers) {
				$io->writeln('No inactive users found');
				return Command::SUCCESS;
			}

            $io->writeln('List of inactive Users since' . $since->format('Y-m-d H:i:s'));
            
            $tableRows = [];
            foreach ($inactiveUsers as $user) {
                $lastLogin = $user->getLastLogin();
                $tableRows[] = [
                    $user->getUsername(),
                    $lastLogin ? $lastLogin->format('Y-m-d H:i:s') : 'Never',
                ];
            }

            $io->table(
                ['Username', 'Last login date'],
                $tableRows
            );

            return Command::SUCCESS;
		} catch (\Exception $error) {
			$io->writeln('<fg=red>Error: </>' . $error->getMessage()); // à compléter, ajouter contexte
			return Command::FAILURE;
		}
    }

    private function subtractMonthsNoOverflow(DateTime $now, int $months): DateTime
    {
        // Day of the month without leading zeros
        $firstDayOfTargetMonth = $now->modify('first day of - ' . $months . ' months');

        $originalDay = (int) $now->format('j');
        $daysInTargetMonth = (int) $firstDayOfTargetMonth->format('t');
        $targetDay = min($originalDay, $daysInTargetMonth);
        
        $targetDate = $firstDayOfTargetMonth->modify('+ ' . ($targetDay - 1) . ' days');

        $targetDate->setTime(
            (int) $now->format('H'),
            (int) $now->format('i'),
            (int) $now->format('s'),
        );

        return $targetDate;
    }
}