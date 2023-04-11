<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use GuzzleHttp\Client;
use App\Entity\Fruit;
use App\Entity\Nutrition;
use App\Entity\FruitFactory;

#[AsCommand(
    name: 'fruits:fetch',
    description: 'Fetch all fruits from http://fruityvice.com and save them to db.',
)]
class FetchFruitCommand extends Command
{
    private $entityManager;
    private $mailManger;

    public function __construct(EntityManagerInterface $entityManager, MailerInterface $mailer)
    {
        $this->entityManager = $entityManager;

        $this->mailManger = $mailer;

        parent::__construct();
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $client = new Client();
        $response = $client->request('GET', 'https://fruityvice.com/api/fruit/all');

        $fruits = json_decode($response->getBody(), true);

        foreach ($fruits as $fruitData) {
            $nutrition = FruitFactory::createNutrition(
                $fruitData['nutritions']['calories'],
                $fruitData['nutritions']['fat'],
                $fruitData['nutritions']['sugar'],
                $fruitData['nutritions']['carbohydrates'],
                $fruitData['nutritions']['protein'],
            );
            $this->entityManager->persist($nutrition);

            $fruit = FruitFactory::createFruit(
                $fruitData['id'],
                $fruitData['name'],
                $fruitData['family'],
                $fruitData['order'],
                $fruitData['genus'],
            );
            $fruit->setNutrition($nutrition);
            $this->entityManager->persist($fruit);
        }

        $this->entityManager->flush();

        $email = (new Email())
            ->from('admin@gmail.com')
            ->to('test@gmail.com')
            ->subject('Report for fruit fetch')
            ->text('Fruits saved to db.');
        $this->mailManger->send($email);
        
        $io->success('Fetched all the fruits.');

        return Command::SUCCESS;
    }
}
