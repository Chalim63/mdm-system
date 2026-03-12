<?php

namespace App\Repository;

use App\Entity\Device;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Device>
 */
class DeviceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Device::class);
    }

    //    /**
    //     * @return Device[] Returns an array of Device objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('d.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Device
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function findBySearchAndSort(?string $search, string $sort, string $direction): array
    {
    $allowedSorts = ['id', 'brand', 'imei', 'serialNumber', 'phoneNumber', 'googleAccount', 'createdAt', 'lastUpd'];
    $allowedDirections = ['asc', 'desc'];

    if (!in_array($sort, $allowedSorts, true)) {
        $sort = 'id';
    }

    $direction = strtolower($direction);

    if (!in_array($direction, $allowedDirections, true)) {
        $direction = 'asc';
    }

    $qb = $this->createQueryBuilder('d');

    if ($search) {
        $qb->andWhere('d.brand LIKE :search
            OR d.imei LIKE :search
            OR d.serialNumber LIKE :search
            OR d.phoneNumber LIKE :search
            OR d.googleAccount LIKE :search')
           ->setParameter('search', '%' . $search . '%');
    }

    $qb->orderBy('d.' . $sort, strtoupper($direction));

    return $qb->getQuery()->getResult();
    }
}
