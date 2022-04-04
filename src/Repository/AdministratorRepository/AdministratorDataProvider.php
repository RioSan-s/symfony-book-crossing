<?php

namespace NonEfTech\BookCrossing\Repository\AdministratorRepository;

use Doctrine\ORM\Mapping as ORM;
use NonEfTech\BookCrossing\Entity\Administrator;

/**
 * @ORM\Entity(repositoryClass=\NonEfTech\BookCrossing\Repository\AdministratorsDoctrineRepository::class)
 * @ORM\Table(name="admin",indexes={
 *     @ORM\Index(name="admin_point_id_idx", columns={"point_id"})
 *     },
 *      uniqueConstraints=
 *     {
 *     @ORM\UniqueConstraint(name="admin_login_unq", columns={"login"})
 *     })
 * Поставщик данных о логине/пароле админа
 */
class AdministratorDataProvider extends Administrator
{
}
