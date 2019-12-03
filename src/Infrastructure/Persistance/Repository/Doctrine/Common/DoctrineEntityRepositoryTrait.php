<?php

namespace App\Infrastructure\Persistance\Repository\Doctrine\Common;

use App\Core\Domain\Model\Shared\AbstractDomainEntity;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

trait DoctrineEntityRepositoryTrait
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ObjectRepository
     */
    private $doctrineRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->doctrineRepository = $entityManager->getRepository(self::ENTITY);
    }

    public function findAll(): array
    {
        return $this->doctrineRepository->findAll();
    }

    public function size(): int
    {
        return $this->entityManager->createQueryBuilder()
            ->select('count(entity.id)')
            ->from(self::ENTITY, 'entity')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function add(AbstractDomainEntity $entity): void
    {
        $this->entityManager->persist($entity);
    }

    public function remove(AbstractDomainEntity $entity): void
    {
        $this->entityManager->remove($entity);
    }
}
