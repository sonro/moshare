<?php

namespace App\DataFixtures;

use App\Core\Domain\Model\Account\Account;
use App\Core\Domain\Model\Account\Priviledge;
use App\Core\Domain\Model\Ledger\Ledger;
use App\Core\Domain\Model\Portfolio\Portfolio;
use App\Core\Domain\Model\Transaction\Transaction;
use App\Core\Domain\Model\Transaction\Transactor;
use App\Core\Domain\Model\User\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // user1
        $user1 = new User();
        $user1->setFirstname('Test');
        $user1->setLastname('One');
        $user1->setActive(true);
        $user1->setEmail('test.name.one@example.com');
        $user1->setPassword(
            $this->encoder->encodePassword($user1, 'password')
        );
        $manager->persist($user1);

        // user2
        $user2 = new User();
        $user2->setFirstname('Test');
        $user2->setLastname('Two');
        $user2->setActive(true);
        $user2->setEmail('test.name.two@example.com');
        $user2->setPassword(
            $this->encoder->encodePassword($user2, 'password')
        );
        $manager->persist($user2);

        // user3
        $user3 = new User();
        $user3->setFirstname('Test');
        $user3->setLastname('Three');
        $user3->setActive(true);
        $user3->setEmail('test.name.three@example.com');
        $user3->setPassword(
            $this->encoder->encodePassword($user3, 'password')
        );
        $manager->persist($user3);

        // user4
        $user4 = new User();
        $user4->setFirstname('Test');
        $user4->setLastname('Four');
        $user4->setActive(true);
        $user4->setEmail('test.name.four@example.com');
        $user4->setPassword(
            $this->encoder->encodePassword($user4, 'password')
        );
        $manager->persist($user4);

        // portfolio1
        $portfolio1 = new Portfolio();
        $portfolio1->setActive(true);
        $portfolio1->setName('Test Portfolio One');
        $portfolio1->addUser($user1);
        $manager->persist($portfolio1);

        // portfolio2
        $portfolio2 = new Portfolio();
        $portfolio2->setActive(true);
        $portfolio2->setName('Test Portfolio Two');
        $portfolio2->addUser($user2);
        $manager->persist($portfolio2);

        // portfolio3
        $portfolio3 = new Portfolio();
        $portfolio3->setActive(true);
        $portfolio3->setName('Test Portfolio Three');
        $portfolio3->addUser($user3);
        $manager->persist($portfolio3);

        // portfolio4
        $portfolio4 = new Portfolio();
        $portfolio4->setActive(true);
        $portfolio4->setName('Test Portfolio Four');
        $portfolio4->addUser($user4);
        $manager->persist($portfolio4);

        // portfolio5
        $portfolio5 = new Portfolio();
        $portfolio5->setActive(true);
        $portfolio5->setName('Test Portfolio Three-Four Joint');
        $portfolio5->addUser($user3);
        $portfolio5->addUser($user4);
        $manager->persist($portfolio5);

        // ledger1
        $ledger1 = new Ledger();
        $ledger1->setName('Test Ledger One');
        $manager->persist($ledger1);

        // ledger2
        $ledger2 = new Ledger();
        $ledger2->setName('Test Ledger Two');
        $manager->persist($ledger2);

        // ledger3
        $ledger3 = new Ledger();
        $ledger3->setName('Test Ledger Three');
        $manager->persist($ledger3);

        // account1
        $account1 = new Account();
        $account1->setName('Test Account One - User One -  Ledger One');
        $account1->setLedger($ledger1);
        $account1->setPortfolio($portfolio1);
        $account1->setPriviledge(new Priviledge(Priviledge::OWNER));
        $manager->persist($account1);

        // account2
        $account2 = new Account();
        $account2->setName('Test Account Two - User Two - Ledger One');
        $account2->setLedger($ledger1);
        $account2->setPortfolio($portfolio2);
        $account2->setPriviledge(new Priviledge(Priviledge::GROUP_EDIT));
        $manager->persist($account2);

        // account3
        $account3 = new Account();
        $account3->setName('Test Account Three - User One - Ledger Two');
        $account3->setLedger($ledger2);
        $account3->setPortfolio($portfolio1);
        $account3->setPriviledge(new Priviledge(Priviledge::OWNER));
        $manager->persist($account3);

        // account4
        $account4 = new Account();
        $account4->setName('Test Account Four - User Two - Ledger Two');
        $account4->setLedger($ledger2);
        $account4->setPortfolio($portfolio2);
        $account4->setPriviledge(new Priviledge(Priviledge::MANAGER));
        $manager->persist($account4);

        // account5
        $account5 = new Account();
        $account5->setName('Test Account Five - User Three - Ledger Two');
        $account5->setLedger($ledger2);
        $account5->setPortfolio($portfolio3);
        $manager->persist($account5);

        // account6
        $account6 = new Account();
        $account6->setName('Test Account Six - User Four - Ledger Two');
        $account6->setLedger($ledger2);
        $account6->setPortfolio($portfolio4);
        $manager->persist($account6);

        // account7
        $account7 = new Account();
        $account7->setName('Test Account Seven - User One - Ledger Three');
        $account7->setLedger($ledger3);
        $account7->setPortfolio($portfolio1);
        $account7->setPriviledge(new Priviledge(Priviledge::OWNER));
        $manager->persist($account7);

        // account8
        $account8 = new Account();
        $account8->setName('Test Account Eight - User Three & Four - Ledger Three');
        $account8->setLedger($ledger3);
        $account8->setPortfolio($portfolio5);
        $manager->persist($account8);

        // Transactor1
        $transactor1 = Transactor::createInternal($account1);
        $manager->persist($transactor1);

        // Transactor2
        $transactor2 = Transactor::createInternal($account2);
        $manager->persist($transactor2);

        // Transactor3
        $transactor3 = Transactor::createInternal($account3);
        $manager->persist($transactor3);

        // Transactor4
        $transactor4 = Transactor::createInternal($account4);
        $manager->persist($transactor4);

        // Transactor5
        $transactor5 = Transactor::createInternal($account5);
        $manager->persist($transactor5);

        // Transactor6
        $transactor6 = Transactor::createInternal($account6);
        $manager->persist($transactor6);

        // Transactor7
        $transactor7 = Transactor::createInternal($account7);
        $manager->persist($transactor7);

        // Transactor8
        $transactor8 = Transactor::createInternal($account8);
        $manager->persist($transactor8);

        // External Transactor1
        $ex1 = Transactor::createExternal('Test Payee 1');
        $manager->persist($ex1);

        // External Transactor2
        $ex2 = Transactor::createExternal('Test Payee 2');
        $manager->persist($ex2);

        // External Transactor3
        $ex3 = Transactor::createExternal('Test Payee 3');
        $manager->persist($ex3);

        // External Transactor4
        $ex4 = Transactor::createExternal('Test Payee 4');
        $manager->persist($ex4);

        // External Transactor5
        $ex5 = Transactor::createExternal('Test Payee 5');
        $manager->persist($ex5);

        // Ledger1 Transaction1
        $l1t1 = new Transaction();
        $l1t1->setTitle('l1t1');
        $l1t1->setDescription('');
        $l1t1->setValue(4000);
        $l1t1->setFrom($transactor1);
        $l1t1->setTo($ex1);
        $manager->persist($l1t1);

        // Ledger1 Transaction2
        $l1t2 = new Transaction();
        $l1t2->setTitle('l1t2');
        $l1t2->setDescription('');
        $l1t2->setValue(10000);
        $l1t2->setFrom($transactor2);
        $l1t2->setTo($ex1);
        $manager->persist($l1t2);

        // Ledger1 Transaction3
        $l1t3 = new Transaction();
        $l1t3->setTitle('l1t3');
        $l1t3->setDescription('');
        $l1t3->setValue(2000);
        $l1t3->setFrom($transactor1);
        $l1t3->setTo($ex2);
        $l1t3->addLiableAccount($account2);
        $manager->persist($l1t3);

        // Ledger1 Transaction4
        $l1t4 = new Transaction();
        $l1t4->setTitle('l1t4');
        $l1t4->setDescription('');
        $l1t4->setValue(6000);
        $l1t4->setFrom($transactor2);
        $l1t4->setTo($transactor1);
        $manager->persist($l1t4);

        // Ledger2 Transaction1
        $l2t1 = new Transaction();
        $l2t1->setTitle('l2t1');
        $l2t1->setDescription('');
        $l2t1->setValue(2000);
        $l2t1->setFrom($transactor3);
        $l2t1->setTo($ex1);
        $manager->persist($l2t1);

        // Ledger2 Transaction2
        $l2t2 = new Transaction();
        $l2t2->setTitle('l2t2');
        $l2t2->setDescription('');
        $l2t2->setValue(2000);
        $l2t2->setFrom($transactor4);
        $l2t2->setTo($ex2);
        $manager->persist($l2t2);

        // Ledger2 Transaction3
        $l2t3 = new Transaction();
        $l2t3->setTitle('l2t3');
        $l2t3->setDescription('');
        $l2t3->setValue(2000);
        $l2t3->setFrom($transactor5);
        $l2t3->setTo($ex3);
        $manager->persist($l2t3);

        // Ledger2 Transaction4
        $l2t4 = new Transaction();
        $l2t4->setTitle('l2t4');
        $l2t4->setDescription('');
        $l2t4->setValue(2000);
        $l2t4->setFrom($transactor6);
        $l2t4->setTo($ex4);
        $manager->persist($l2t4);

        // Ledger3 Transaction1
        $l3t1 = new Transaction();
        $l3t1->setTitle('l3t1');
        $l3t1->setDescription('');
        $l3t1->setValue(2000);
        $l3t1->setFrom($transactor7);
        $l3t1->setTo($ex1);
        $manager->persist($l3t1);

        // Ledger3 Transaction1
        $l3t2 = new Transaction();
        $l3t2->setTitle('l3t2');
        $l3t2->setDescription('');
        $l3t2->setValue(500);
        $l3t2->setFrom($transactor8);
        $l3t2->setTo($ex5);
        $manager->persist($l3t2);

        $manager->flush();
    }
}
