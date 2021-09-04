<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CollegeController
 * @package App\Controller\Api
 */
class CollegeController extends Controller
{
    /**
     * @Route(path="college-list", name="collegeList", methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getCollegeList(Request $request): JsonResponse
    {
        $page = $request->get('page', 1);
        $perPage = $request->get('perPage', 20);

        if ($page <= 0) {
            $page = 1;
        }

        if ($perPage > 20 || $perPage <= 0) {
            $perPage = 20;
        }

        $clgRepo = $this->getDoctrine()->getRepository('App:College');
        $colleges = $clgRepo->createQueryBuilder('c')
        ->select('c.id', 'c.schoolLogo', 'c.schoolImageUrl', 'c.schoolName', 'c.address', 'c.email', 'c.schoolNumber', 'c.totalEnrollment', 'c.totalExpenses',
        'c.acceptanceRate', 'c.awardsOffered', 'c.programsMajors', 'c.studentToFacultyRatio', 'c.SATEvidenceBasedReadingAndWriting',
            'c.SATMath', 'c.ACTComposite', 'c.ACTEnglish', 'c.ACTMath', 'c.financialAid', 'c.campusSetting', 'c.modeOfTransportation', 'c.religiousAssociation',
        'c.religiousAssociation', 'c.sport', 'c.clubActivities', 'c.collegeCategory', 'c.region', 'c.website', 'c.request', 'c.apply',
        'c.visit', 'c.state', 'c.americanIndianOrAlaskanNative', 'c.asian', 'c.blackOrAfricanAmerica', 'c.hispanicOrLatino',
        'c.nativeHawaiianOrOtherPacificIslander', 'c.white', 'c.twoOrMoreRaces', 'c.unknownRace', 'c.nonResidentAlien',
        'c.fourYear', 'c.fiveYear', 'c.sixYear', 'c.eightYear', 'c.onlyDistanceEducation', 'c.someDistanceEducation',
        'c.notEnrolledDistanceEducation')
        ->getQuery()
            ->setFirstResult(($page - 1) * 20)
            ->setMaxResults($perPage)->getArrayResult();
        return new JsonResponse([
            'colleges' =>   ($colleges),
            'perPage' => count($colleges),
            'page' => $page
        ], 200);
    }

    /**
     * @Route(path="getCollege/{id}", name="getCollege")
     * @param int $id
     * @return JsonResponse
     */
    public function getCollege(int $id): JsonResponse
    {
        $clgRepo = $this->getDoctrine()->getRepository('App:College');
        $college = $clgRepo->createQueryBuilder('c')
            ->select('c.id', 'c.schoolLogo', 'c.schoolImageUrl', 'c.schoolName', 'c.address', 'c.email', 'c.schoolNumber', 'c.totalEnrollment', 'c.totalExpenses',
            'c.acceptanceRate', 'c.awardsOffered', 'c.programsMajors', 'c.studentToFacultyRatio', 'c.SATEvidenceBasedReadingAndWriting',
                'c.SATMath', 'c.ACTComposite', 'c.ACTEnglish', 'c.ACTMath', 'c.financialAid', 'c.campusSetting', 'c.modeOfTransportation', 'c.religiousAssociation',
            'c.religiousAssociation', 'c.sport', 'c.clubActivities', 'c.collegeCategory', 'c.region', 'c.website', 'c.request', 'c.apply',
            'c.visit', 'c.state', 'c.americanIndianOrAlaskanNative', 'c.asian', 'c.blackOrAfricanAmerica', 'c.hispanicOrLatino',
            'c.nativeHawaiianOrOtherPacificIslander', 'c.white', 'c.twoOrMoreRaces', 'c.unknownRace', 'c.nonResidentAlien',
            'c.fourYear', 'c.fiveYear', 'c.sixYear', 'c.eightYear', 'c.onlyDistanceEducation', 'c.someDistanceEducation',
            'c.notEnrolledDistanceEducation')
            ->where('c.id = :id')
            ->setParameter('id', $id)
            ->getQuery()->getArrayResult();

        return new JsonResponse([
            'college' => $college
        ], 200);
    }
}