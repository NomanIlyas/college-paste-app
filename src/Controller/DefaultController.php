<?php

namespace App\Controller;

use App\Repository\StudentRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;


/**
 * Class DefaultController
 * @package Ekomi\AdminBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @return RedirectResponse
     */
    public function indexAction()
    {
        return $this->redirectToRoute('fos_user_security_login');
    }

    /**
     * @param UserRepository $userRepository
     * @return QueryBuilder
     */
    public function getStudentUsers(UserRepository $userRepository): QueryBuilder
    {
        return $userRepository
            ->createQueryBuilder('u')
            ->where('u.roles LIKE :student')
            ->setParameter('student', '%ROLE_STUDENT%')
            ->orderBy('u.id', 'DESC');
    }

    /**
     * @param UserRepository $userRepository
     * @return QueryBuilder
     */
    public function getCollegeUsers(UserRepository $userRepository): QueryBuilder
    {
        return $userRepository
            ->createQueryBuilder('u')
            ->where('u.roles LIKE :college')
            ->setParameter('college', '%ROLE_COLLEGE%')
            ->setMaxResults('10')
            ->orderBy('u.id', 'DESC');
    }
}
