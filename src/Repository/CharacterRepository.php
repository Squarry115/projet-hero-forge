<?php

namespace App\Repository;

use App\Entity\Character;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Character>
 */
class CharacterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Character::class);
    }

    public function findByFilters(?string $name, ?string $race, ?string $class): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT c.id, c.name, c.level, c.str, c.dex, c.con, c.int, c.wis, c.cha,
                   c.hit_points, c.image,
                   r.name as race_name, r.id as race_id,
                   cl.name as class_name, cl.id as class_id, cl.hit_dice
            FROM character c
            LEFT JOIN race r ON c.id_race_id = r.id
            LEFT JOIN character_class cl ON c.class_id_id = cl.id
            WHERE 1=1
        ';

        $params = [];

        if ($name) {
            $sql .= ' AND c.name LIKE :name';
            $params['name'] = '%' . $name . '%';
        }

        if ($race) {
            $sql .= ' AND r.name LIKE :race';
            $params['race'] = '%' . $race . '%';
        }

        if ($class) {
            $sql .= ' AND cl.name LIKE :class';
            $params['class'] = '%' . $class . '%';
        }

        return $conn->executeQuery($sql, $params)->fetchAllAssociative();
    }
}
