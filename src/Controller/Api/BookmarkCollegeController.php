<?php

namespace App\Controller\Api;

use App\Entity\BookmarkColleges;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BookmarkCollegeController extends Controller
{
    /**
     * @Route(path="bookmark", name="bookmarkCollege",  methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function bookmarkSwapAction(Request $request): JsonResponse
    {
        $repo = $this->getDoctrine()->getManager()->getRepository('App:BookmarkColleges');

        if (!empty($this->getUser())) {
            $data = json_decode($request->getContent(), true);
            $isExist = $repo->findBy([
                'userId' => $this->getUser()->getId(),
                'collegeId' => $data['collegeId']
            ]);
            if (empty($isExist)) {
                $bookmark = new BookmarkColleges();
                $bookmark->setUserId($this->getUser()->getId());
                $bookmark->setCollegeId($data['collegeId']);
                $this->getDoctrine()->getManager()->persist($bookmark);
                $this->getDoctrine()->getManager()->flush();

                return new JsonResponse([
                    'status' => 'Bookmark Added Successfully!'
                ]);
            } else {
                $repo->createQueryBuilder('b')
                ->delete()
                ->where('b.collegeId = :cid')
                ->andWhere('b.userId = :uid')
                ->setParameter('cid', $data['collegeId'])
                ->setParameter('uid', $this->getUser()->getId())
                ->getQuery()->getResult();

                return new JsonResponse([
                    'status' => 'Bookmark Removed Successfully!'
                ]);
            }
        }

        return new JsonResponse([
            'status' => false
        ]);
    }

    /**
     * @Route(path="getBookmarkColleges", name="bookmarkCollegeList",  methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getBookmarkCollegeListAction(Request $request): JsonResponse
    {
        $repo = $this->getDoctrine()->getManager()->getRepository('App:BookmarkColleges');
        $clgRepo = $this->getDoctrine()->getManager()->getRepository('App:College');

        if (!empty($this->getUser())) {
            $usersColleges = $repo->createQueryBuilder('b')
                ->select('b.collegeId as cid')
                ->where('b.userId = :uid')
                ->setParameter('uid', $this->getUser()->getId())
                ->getQuery()->getArrayResult();
            $usersColleges = array_column($usersColleges, 'cid');

            $colleges = $clgRepo->createQueryBuilder('c')
                ->where('c.id IN (:ids)')
                ->setParameter('ids', $usersColleges)
                ->getQuery()->getArrayResult();

            return new JsonResponse([
                'bookmarkCollege' => $colleges
            ]);
        }

        return new JsonResponse([
            'status' => false
        ]);
    }
}
