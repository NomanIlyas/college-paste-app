<?php

namespace App\Controller\Api;

use App\Entity\College;
use App\Entity\Student;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Route("/auth")
 */
class SecurityController extends AbstractController
{
    /**
     * @Route("/register", name="api_auth_register",  methods={"POST"})
     * @param Request $request
     * @param UserManagerInterface $userManager
     * @return JsonResponse|RedirectResponse
     * @throws \Exception
     */
    public function register(Request $request, UserManagerInterface $userManager)
    {
        $data = json_decode(
            $request->getContent(),
            true
        );
        $validator = Validation::createValidator();
        $constraint = new Assert\Collection(array(
            // the keys correspond to the keys in the input array
            'firstname' => new Assert\Length(array('min' => 1)),
            'lastname' => new Assert\Length(array('min' => 1)),
            'password' => new Assert\Length(array('min' => 1)),
            'email' => new Assert\Email(),
        ));
        $violations = $validator->validate($data, $constraint);
        if ($violations->count() > 0) {
            return new JsonResponse(["error" => (string)$violations], 500);
        }

        if ($userManager->findUserByUsername($data['email']) || $userManager->findUserByEmail($data['email'])) {
            return new JsonResponse(["Error" => 'Username/Email already Exist'], 500);
        }

        $username = $data['email'];
        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $password = $data['password'];
        $email = $data['email'];
        $user = new User();
        $user
            ->setUsername($username)
            ->setPlainPassword($password)
            ->setEmail($email)
            ->setEnabled(true)
            ->setRoles(['ROLE_USER', 'ROLE_STUDENT'])
            ->setSuperAdmin(false);
        $student = new Student();
        $student
            ->setFirstname($firstname)
            ->setLastname($lastname)
            ->setEmail($email)
            ->setUser($user);
        $this->getDoctrine()->getManager()->persist($student);
        try {
            $userManager->updateUser($user);
            $this->getDoctrine()->getManager()->flush();
        } catch (\Exception $e) {
            return new JsonResponse(["error" => $e->getMessage()], 500);
        }

        return new JsonResponse([
            'status' => true,
            'email' => $email
        ], 200);
    }

    /**
     * @Route("/update-student", name="api_update_student",  methods={"PUT"})
     * @param Request $request
     * @param UserManagerInterface $userManager
     * @return JsonResponse|RedirectResponse
     * @throws \Exception
     */
    public function updateStudent(Request $request, UserManagerInterface $userManager)
    {
        if (empty($this->getUser()))
        {
            return new JsonResponse([
                'status' => 404
            ], 404);
        }
        $mainData = $request->query->all();

        /* Update USER */
        $user = $this->getUser();
        $user->setAddress(isset($mainData['address']) ? $mainData['address'] : null);
        $user->setFirstname(isset($mainData['firstname']) ? $mainData['firstname'] : null);
        $user->setLastname(isset($mainData['lastname']) ? $mainData['lastname'] : null);
        $user->setPrimaryNumber(isset($mainData['mobile_number']) ? $mainData['mobile_number'] : null);

        /* Update Student*/
        $student = $user->getStudent();
        $student->setFirstname(isset($mainData['firstname']) ? $mainData['firstname'] : null);
        $student->setLastname(isset($mainData['lastname']) ? $mainData['lastname'] : null);
        $student->setMobileNumber(isset($mainData['mobile_number']) ? $mainData['mobile_number'] : null);
        $student->setAddress(isset($mainData['address']) ? $mainData['address'] : null);
        $student->setDateOfBirth(isset($mainData['dob']) ? new \DateTime($mainData['dob']) : null);
        $student->setFirstGeneration
        (isset($mainData['first_generation']) ? $mainData['first_generation'] : null);
        $student->setActiveMilitary(isset($mainData['active_military']) ? $mainData['active_military'] : null);
        $student->setUnitNumber(
            isset($mainData['apt_number']) && is_integer((int)$mainData['apt_number'])
            && (!is_string((int)$mainData['apt_number']))
                ?
                (int)$mainData['apt_number'] : null);
        $student->setSchoolStartTime(
            isset($mainData['school_start_term']) ? $mainData['school_start_term'] : null);
        $student->setEducationLevelCompleted(isset($mainData['grade_level_complete']) ? $mainData['grade_level_complete'] : null);
        $student->setRaceEthnicity(isset($mainData['race_ethnicity']) &&
        isset($this->getParameter('raceEthnicity')[$mainData['race_ethnicity']]) ? $this->getParameter('raceEthnicity')[$mainData['race_ethnicity']] : null);
        $student->setUser($user);
        $this->getDoctrine()->getManager()->persist($student);

        try {
            $userManager->updateUser($user);
            $this->getDoctrine()->getManager()->flush();
        } catch (\Exception $e) {
            return new JsonResponse(["error" => $e->getMessage()], 500);
        }
        return new JsonResponse([
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'user_id' => $user->getId(),
            'student' => [
               'firstname' => $student->getFirstName(),
               'lastName' => $student->getLastName(),
               'address' => $student->getAddress(),
               'dob' => $student->getDateOfBirth(),
               'firstGeneration' => ($student->getFirstGeneration() !== false ? 'yes' : 'no'),
               'activeMilitary' => ($student->getActiveMilitary() !== false ? 'yes' : 'no'),
               'unitNumber' => $student->getUnitNumber(),
               'schoolStartTime' => $student->getSchoolStartTime(),
               'educationLevelCompleted' => $student->getEducationLevelCompleted(),
               'raceEthnicity' => $student->getRaceEthnicity(),
            ]
        ], 200);
    }


    /**
     * @Route(path="/getUser", name="api_get_user",  methods={"GET"})
     * @param Request $request
//     * @param UserManagerInterface $userManager
     * @return JsonResponse|RedirectResponse
     */
    public function getCurrentUser(Request $request)
    {
        $user = $this->getUser();
        $student = $user->getStudent();
        return new JsonResponse([
          'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'user_id' => $user->getId(),
            'student' => [
                'firstname' => $student->getFirstName(),
                'lastName' => $student->getLastName(),
                'address' => $student->getAddress(),
                'dob' => $student->getDateOfBirth(),
                'firstGeneration' => $student->getFirstGeneration(),
                'activeMilitary' => $student->getActiveMilitary(),
                'unitNumber' => $student->getUnitNumber(),
                'schoolStartTime' => $student->getSchoolStartTime(),
                'educationLevelCompleted' => $student->getEducationLevelCompleted(),
                'raceEthnicity' => $student->getRaceEthnicity(),
            ]
        ], 200);
    }

}