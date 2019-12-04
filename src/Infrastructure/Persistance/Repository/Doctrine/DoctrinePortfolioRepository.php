<?php

namespace App\Infrastructure\Persistance\Repository\Doctrine;

use App\Core\Domain\Model\Portfolio\Portfolio;
use App\Core\Domain\Model\User\User;
use App\Core\Domain\Repository\PortfolioRepositoryInterface;
use App\Infrastructure\Persistance\Repository\Doctrine\Common\DoctrineEntityRepositoryTrait;

final class DoctrinePortfolioRepository implements PortfolioRepositoryInterface
{
    use DoctrineEntityRepositoryTrait;

    public function findOne(int $id): ?Portfolio
    {
        return $this->doctrineRepository->find($id);
    }

    public function findOneByName(string $name): ?Portfolio
    {
        return $this->doctrineRepository->findOneBy(['name' => $name]);
    }

    public function findAllByUser(User $user): array
    {
        $query = $this->entityManager->createQueryBuilder()
            ->select(
                'portfolio'
                .',users'
                .',accounts'
                .',ledger'
            )
            ->from(self::ENTITY, 'portfolio')
            ->join('portfolio.accounts', 'accounts')
            ->join('accounts.ledger', 'ledger')
            ->join('portfolio.users', 'users')
            ->where('portfolio IN (:userPortfolios)')
            ->setParameter('userPortfolios', $user->getPortfolios())
            ->getQuery();

        return $query->getResult();
    }
}
