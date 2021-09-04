<?php

namespace App\Controller\Api;

use App\Entity\College;
use App\Entity\Question;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\s;

class QuestionController extends Controller
{
    /**
     * @Route(path="questionaire-list", name="questionaireList")
     */
    public function getQuestionList()
    {
        $quesRepo = $this->getDoctrine()->getRepository('App:Question');
        $questions = $quesRepo->createQueryBuilder('q')
        ->select('q.id', 'q.questionText', 'q.questionCategory', 'q.questionType', 'q.answers')
        ->getQuery()->getArrayResult();

        return new JsonResponse([
            'questions' => $questions,
        ]);
    }

    /**
     * @Route(path="submitAnswers", name="submitAnswers",  methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function submitAnswers(Request $request): JsonResponse
    {
        $questionMapping = [
            'How do you prefer to get around?' => [
                'My car' => [
                    'citySmall', 'cityMidsize', 'cityLarge',
                    'suburbSmall', 'suburbMidsize', 'suburbLarge',
                    'townRemote', 'townFringe', 'townDistant',
                    'ruralRemote', 'ruralFringe', 'ruralDistant',
                ],
                'I like to walk everywhere' => [
                    'citySmall', 'cityMidsize', 'cityLarge',
                    'suburbSmall', 'suburbMidsize', 'suburbLarge',
                    'townRemote', 'townFringe', 'townDistant',
                    'ruralRemote', 'ruralFringe', 'ruralDistant',
                ],
                'Biking or on a scooter is nice' => [
                    'citySmall', 'cityMidsize', 'cityLarge',
                    'suburbSmall', 'suburbMidsize', 'suburbLarge',
                    'townRemote', 'townFringe', 'townDistant',
                    'ruralRemote', 'ruralFringe', 'ruralDistant',
                ],
                'Public transportation' => [
                    'citySmall', 'cityMidsize', 'cityLarge',
                    'suburbSmall', 'suburbMidsize', 'suburbLarge',
                    'townRemote', 'townFringe', 'townDistant',
                ],
            ],
            'When you wake up, what do you see out your window?' => [
                'The concrete jungle' => [
                    'citySmall', 'cityMidsize', 'cityLarge',
                ],
                'Good ole’ farmland' => [
                    'townRemote', 'townFringe', 'townDistant',
                    'ruralRemote', 'ruralFringe', 'ruralDistant',
                ],
                'Some sort of woodland area' => [
                    'suburbSmall', 'suburbMidsize', 'suburbLarge',
                    'townRemote', 'townFringe', 'townDistant',
                    'ruralRemote', 'ruralFringe', 'ruralDistant',
                ],
                'Mountains or hills' => [
                    'citySmall', 'cityMidsize', 'cityLarge',
                    'suburbSmall', 'suburbMidsize', 'suburbLarge',
                    'townRemote', 'townFringe', 'townDistant',
                    'ruralRemote', 'ruralFringe', 'ruralDistant',
                ],
                'Body of water' => [
                    'citySmall', 'cityMidsize', 'cityLarge',
                    'suburbSmall', 'suburbMidsize', 'suburbLarge',
                    'townRemote', 'townFringe', 'townDistant',
                    'ruralRemote', 'ruralFringe', 'ruralDistant',
                ],
            ],
            'I would prefer' => [
                'Rural living'  => [
                    'townRemote', 'townFringe', 'townDistant',
                    'ruralRemote', 'ruralFringe', 'ruralDistant',
                ],
                'In the heart of the city' => [
                    'citySmall', 'cityMidsize', 'cityLarge',
                ],
                'Being near the city, but not too close' => [
                    'suburbSmall', 'suburbMidsize', 'suburbLarge',
                    'townRemote', 'townFringe', 'townDistant',
                ],
                'Small town, USA' => [
                    'citySmall',
                    'suburbSmall',
                    'townRemote', 'townFringe', 'townDistant',
                ],
                'Living somewhere remote' => [
                    'citySmall','suburbSmall',
                    'townRemote', 'townFringe', 'townDistant',
                    'ruralRemote', 'ruralFringe', 'ruralDistant',
                ],
            ],
        ];
        $religionQuestionMapping = [
            'What is religious worship to you?' => [
                "A vital part of my life" => [
                    'Applicable', 1,
                ],
                "I’ll devote at least one day out of the week" => [
                    'Not applicable', 0, 1, 'Applicable',
                ],
                "I'll devote at least one day out of the week" => [
                    'Not applicable', 0, 1, 'Applicable',
                ],
                "It’s important so I’ll make it out when I can" => [
                    'Not applicable', 0, 1, 'Applicable',
                ],
                "It's important so I'll make it out when I can" => [
                    'Not applicable', 0, 1, 'Applicable',
                ],
                "I’m not too religious" => [
                    'Not applicable', 0,
                ],
                "I'm not too religious" => [
                    'Not applicable', 0,
                ],
            ],
        ];
        $regionStateArr = [];
        $religionSetting = [];
        $campusSetting = [];
        $sport = $degree = $major =  [];
        $clubs = [];
        $count = 0;
        $str = $studentCount = $graduationTimeLine = $financialAid = $act = $sat = null;
        $data = json_decode($request->getContent(), true);
        $quesRepo = $this->getDoctrine()->getRepository('App:Question');
        $colgRepo = $this->getDoctrine()->getRepository('App:College');

        foreach ($data as $answer) {
            /** No need to use these on logic for now */
            if (in_array((int)$answer['question_id'], [1, 2, 4, 5, 9, 12, 16, 25])) {
                continue;
            }
            /** @var Question $question */
            $question = $quesRepo->find((int)$answer['question_id']);
            if ($question) {
                if ($question->getQuestionCategory() == 'Preferred Location') {
                    if ($question->getQuestionType() === 'map' || $question->getQuestionText() == 'Select one or more states') {
                        $regionStateArr[] = $answer['value'];
                    } elseif(isset($questionMapping[$question->getQuestionText()])) {
                        $value = $answer['value'];
                        $campusSetting[] = isset($questionMapping[$question->getQuestionText()][$value]) ?
                            $questionMapping[$question->getQuestionText()][$value] : [
                                'nothing',
                            ];
                    } else {
                        $value = $answer['value'];
                        $religionSetting[] = isset($religionQuestionMapping[$question->getQuestionText()][$value]) ?
                            $religionQuestionMapping[$question->getQuestionText()][$value] : [
                                'Not applicable', 0,
                            ];
                    }
                } elseif ($question->getQuestionCategory() == 'Personal Interests') {
                    if ($question->getQuestionText() == 'Which sports do you enjoy to watch or play') {
                        $sport = $answer['extra'];
                    } elseif ($question->getQuestionText() == 'What clubs or extracurricular would you be interested in?') {
                        $clubs = $answer['extra'];
                    } elseif ($question->getQuestionText() == 'What is a reasonable amount of time to devote to study?') {
                        $str = $this->getAcceptanceRate($answer['value']);
                    } elseif ($question->getQuestionText() == 'Large crowds') {
                        $studentCount = $this->getStudentCount($answer['value']);
                    } elseif ($question->getQuestionText() == 'How would you describe yourself?') {
//                        $graduationTimeLine = $this->getGraduationTimeLine($answer['value']);
                    }
                } elseif ($question->getQuestionCategory() == 'College Type') {
                    if ($question->getQuestionText() == 'Which type of school are you interested in?') {
                        $schools = $this->getSchools($answer['extra'], $str, $studentCount);
                    } elseif ($question->getQuestionText() == 'How long do you plan to be in school?') {
                        $this->getPlanSchool($schools, $answer['value']);
                    } elseif ($question->getQuestionText() == 'How do you plan to pay for school?') {
                        $financialAid = $this->getFinancialAid($answer['value']);
                    } elseif ($question->getQuestionText() == 'What learning environment best suits your needs?') {
                        $environment = $this->getEnvironment($answer['value'], $studentCount);
                    } elseif ($question->getQuestionText() == 'How important is diversity to your college experience?') {
                        $diversity = $this->getDiversity($answer['value']);
                    } elseif ($question->getQuestionText() == 'SAT Scores') {
//                        $sat = $this->getSATQuery($answer['extra']);
                    } elseif ($question->getQuestionText() == 'ACT Scores') {
//                        $act = $this->getACTQuery($answer['extra']);
                    } elseif ($question->getQuestionText() == 'How important are athletics to you?') {
                        $count = $this->getSportCount($answer['value']);
                    }
                } elseif ($question->getQuestionCategory() == 'Academic Interests') {
                    if ($question->getQuestionText() == 'Which College Degree are you seeking?') {
                        foreach ($answer['extra'] as $value) {
                            $this->getPlanSchool($schools, $value);
                        }
                    } elseif ($question->getQuestionText() == 'What field of study interests you?') {
                        $major = $answer['extra'];
                    }
                }
            }
        }
        $arr = [];
        foreach ($campusSetting as $item) {
            foreach ($item as $value) {
                $arr[] = $value;
            }
        }
        $campusSetting = array_unique($arr);
        $sport = implode("|", $sport);
        $clubs = implode("|", $clubs);
        $major = implode("|", $major);
        $qb = $colgRepo->createQueryBuilder('c')
            ->where('c.campusSetting IN (:campus)')
            ->andWhere('c.region IN (:region) OR c.state IN (:region)')
            ->andWhere('c.religiousAssociation IN (:religion)')
            ->andWhere('REGEXP(c.sport, :sport) = true')
            ->andWhere('REGEXP(c.clubActivities, :club) = true')
            ->andWhere('REGEXP(c.programsMajors, :major) = true')
            ->andWhere($str)
            ->andWhere($studentCount)
//            ->andWhere($graduationTimeLine)
            ->andWhere($financialAid)
//            ->andWhere($sat)
//            ->andWhere($act)
            ->setParameter('campus', $campusSetting)
            ->setParameter('religion', $religionSetting)
            ->setParameter('region', $regionStateArr)
            ->setParameter('sport', $sport)
            ->setParameter('club', $clubs)
            ->setParameter('major', $major);
        if (!empty($schools)) {
            $schools = array_unique($schools);
            $schools = implode("|", $schools);
            $qb->andWhere('REGEXP(c.collegeCategory, :regexp) = true')
                ->setParameter('regexp', $schools);
        }
        if (!empty($environment)) {
            $qb->andWhere($environment);
        }
        if (!empty($diversity)) {
            $qb->andWhere($diversity);
        }

        $colleges = $qb
            ->getQuery()->getArrayResult();
        $arr = [];
        /** @var College $college */
        foreach ($colleges as $college) {
            if ($count == -1) {
                if (!empty($college['sport']) && count($college['sport']) >= 1) {
                    $arr[] = $college;
                }
            } elseif ($count == 1) {
                if (!empty($college['sport']) && count($college['sport']) >= 5) {
                    $arr[] = $college;
                }
            } else {
                if (!empty($college['sport']) && count($college['sport']) < 5) {
                    $arr[] = $college;
                }
            }
        }

        return new JsonResponse([
            'colleges' => $arr,
        ]);
    }

    /**
     * @Route(path="getQuestion/{id}", name="getQuestion")
     * @param int $id
     * @return JsonResponse
     */
    public function getQuestion(int $id): JsonResponse
    {
        $quesRepo = $this->getDoctrine()->getRepository('App:Question');
        $question = $quesRepo->createQueryBuilder('q')
            ->select('q.id', 'q.questionText', 'q.questionCategory', 'q.questionType', 'q.answers')
            ->where('q.id = :id')
            ->setParameter('id', $id)
            ->getQuery()->getArrayResult();

        return new JsonResponse([
            'question' => $question,
        ], 200);
    }

    /**
     * @param $value
     * @return string
     */
    private function getAcceptanceRate($value): string
    {
        if ($value == 'Studying should be life') {
            return 'c.acceptanceRate < 30';
        } elseif ($value == '2-5 hours per week, tops!') {
            return 'c.acceptanceRate >= 50';
        } elseif ($value == 'I can get a good 2-4 hours per day') {
            return 'c.acceptanceRate < 50';
        } else {
            return 'c.acceptanceRate >= 80';
        }
    }

    /**
     * @param $value
     * @return string
     */
    private function getStudentCount($value): string
    {
        if ($value == 'Make me nervous') {
            return 'c.totalEnrollment < 2500';
        } elseif ($value == 'Are fun to disappear in') {
            return 'c.totalEnrollment >= 5000';
        } elseif ($value == 'Bring out the best in me') {
            return 'c.totalEnrollment < 10000';
        } else {
            return 'c.totalEnrollment >= 0';
        }
    }

    /**
     * @param $value
     * @return string
     */
    private function getGraduationTimeLine($value): string
    {
        if ($value == 'Workaholic') {
            return 'c.fourYear >= 40';
        } elseif ($value == 'Active and on the go') {
            return 'c.fiveYear >= 50';
        } elseif ($value == 'I came to party') {
            return 'c.sixYear < 50';
        } else {
            return 'c.eightYear < 30';
        }
    }

    private function getSchools($extra, ?string &$str, ?string &$studentCount): array
    {
        $arr = [];
        $flag = false;
        foreach ($extra as $item) {
            if ($item == 'Big State School') {
                $studentCount .= ' OR c.totalEnrollment > 10000';
                $arr[] = 'PublicSchools';
                $arr[] = 'HistoricallyBlackCollegesAndUniversities';
                $arr[] = '4-YearPrograms';
            }
            if ($item == 'Smaller Public School') {
                $studentCount .= ' OR c.totalEnrollment < 5000';
                $arr[] = 'PublicSchools';
                $arr[] = 'HistoricallyBlackCollegesAndUniversities';
                $arr[] = '4-YearPrograms';
                $arr[] = '2-YearPrograms';
            }
            if ($item == 'Small Liberal Arts College') {
                $arr[] = 'PublicSchools';
                $arr[] = 'PrivateSchools';
                $arr[] = 'HistoricallyBlackCollegesAndUniversities';
                $arr[] = '4-YearPrograms';
                $arr[] = '2-YearPrograms';
            }
            if ($item == 'Private School') {
                $arr[] = 'PrivateSchools';
                $arr[] = '4-YearPrograms';
                $arr[] = '2-YearPrograms';
            }
            if ($item == 'Ivy League Caliber') {
                $flag = true;
                $str .= ' OR c.acceptanceRate < 15';
            }
            if ($item == 'HBCU') {
                $arr[] = 'HistoricallyBlackCollegesAndUniversities';
                $arr[] = '4-YearPrograms';
                $arr[] = '2-YearPrograms';
            }
            if ($item == 'Easy to get into') {
                $flag = true;
                $str .= ' OR c.acceptanceRate > 80';
            }
        }

        if ($flag) {
            return [];
        }

        return $arr;
    }

    /**
     * @param array $schools
     * @param $value
     */
    private function getPlanSchool(array &$schools, $value)
    {
        if ($value == '2 years') {
            $schools[] = 'PublicSchools';
            $schools[] = 'PrivateSchools';
            $schools[] = '2-YearPrograms';
        } elseif ($value == '4 years' || $value == 'I’m going straight through Grad School' || $value == "I'm going straight through Grad School"
        || $value == "Bachelor's Degree" || $value == "Graduate Degree" || $value == "Master's Degree"
        || $value == "Doctoral Degree") {
            $schools[] = 'PublicSchools';
            $schools[] = 'PrivateSchools';
            $schools[] = '4-YearPrograms';
        } elseif ($value == 'No more than 5 years') {
            $schools[] = 'PublicSchools';
            $schools[] = 'PrivateSchools';
            $schools[] = '2-YearPrograms';
            $schools[] = '4-YearPrograms';
        } elseif ($value == "Associate's Degree") {
            $schools[] = 'PublicSchools';
            $schools[] = 'PrivateSchools';
            $schools[] = '2-YearPrograms';
            $schools[] = '4-YearPrograms';
        }
    }

    /**
     * @param $value
     * @return string
     */
    private function getFinancialAid($value): string
    {
        if ($value == 'My parents will pay') {
            return 'c.financialAid < 30';
        } else {
            return 'c.financialAid > 25';
        }
    }

    /**
     * @param $value
     * @param string|null $studentCount
     * @return string|null
     */
    private function getEnvironment($value, ?string &$studentCount): ?string
    {
        if ($value == 'I need really small classes like less than 10 students') {
            $studentCount .= ' OR c.totalEnrollment < 5000';
        } elseif($value == 'Anything less than 30 is reasonable') {
            $studentCount .= ' OR c.totalEnrollment > 5000';
        } elseif($value == 'The Bigger, the better') {
            $studentCount .= ' OR c.totalEnrollment > 10000';
        } else {
            return 'c.onlyDistanceEducation >= 75';
        }
        return null;
    }

    /**
     * @param $value
     * @return string|null
     */
    private function getDiversity($value): ?string
    {
        if ($value == 'I want to be in a melting pot') {
            return 'c.white < 65';
        }
        return null;
    }

    /**
     * @param $extra
     * @return string
     */
    private function getSATQuery($extra): string
    {
        return 'c.SATEvidenceBasedReadingAndWriting <= '. $extra[0]['value']
            . ' OR c.SATEvidenceBasedReadingAndWriting <= '. $extra[2]['value'] . ' AND c.SATMath <= ' . $extra[1]['value'];
    }

    /**
     * @param $extra
     * @return string
     */
    private function getACTQuery($extra): string
    {
        return 'c.ACTComposite <= '. $extra[4]['value']
            . ' AND c.ACTMath <= '. $extra[2]['value'] . ' AND c.ACTEnglish <= ' . $extra[0]['value'];
    }

    /**
     * @param $value
     * @return int
     */
    private function getSportCount($value): int
    {
        if ($value == 'Sports are everything!') {
            return 1;
        } elseif ($value == 'Eh not really a fan') {
            return 0;
        } else {
            return -1;
        }
    }
}