<?php

namespace App\Infrastructure\Persistance\Repository\Doctrine\Common;

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
}
