<?php

namespace App\Infrastructure\Persistance\Repository\Doctrine\Common;

use App\Core\Domain\Model\Shared\AbstractDomainEntity;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

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

    // /**
    //  * @var string
    //  */
    // protected $entityClassName;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->doctrineRepository = $entityManager->getRepository(
            $this->entityClassName
        );
    }

    public function findAll(): array
    {
        return $this->doctrineRepository->findAll();
    }

    public function size(): int
    {
        return $this->entityManager
            ->createQueryBuilder()
            ->select('count(entity.id)')
            ->from($this->entityClassName, 'entity')
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
