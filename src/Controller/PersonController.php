<?php
/**
 * Portus Project
 * PersonController.php
 * Developed by Juanan Ruiz
 * Created 9/5/16 - 16:55
 * Powered by PhpStorm.
 */

namespace US\Portus\Controller;

use US\Portus\Entity\Person;
use US\Portus\Repository\PersonRepository;
use Silex\Application;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PersonController
{

    /**
     * @var personRepository
     */
    protected $personRepository;

    /**
     * @param PersonRepository $personRepository
     */
    function __construct(PersonRepository $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    /**
     * function indexAction
     * @param Application $app
     * @param $page
     * @param $limit
     * @return Response
     */
    public function indexAction(Application $app, $page, $limit)
    {
        $criteria = array();
        $orderBy = array();
        // Paginación
        $currentPage = $page;
        $total = $this->personRepository->count();
        $numPages = ceil($total / $limit);
        if ($currentPage < 1) {
            $currentPage = 1;
        } else if ($currentPage > $numPages) {
            $currentPage = $numPages;
        }
        $offset = ($currentPage - 1) * $limit;

        $people = $this->personRepository->findBy($criteria, $orderBy, $limit, $offset);
        return $app['twig']->render('person/person_index.html.twig', array(
            'people' => $people,
            'currentPage' => $currentPage,
            'numPages' => $numPages,
            'url' => $app['url_generator']->generate('people'),
        ));
    }

    /**
     * @param Application $app
     * @param $id
     * @return Response/RedirectResponse
     */
    public function viewAction(Application $app, $id)
    {
        /** @var Person $person */
        $person = $this->personRepository->find($id);
        if ($person) {
            $items = $person->getItems();
            $jobs = $app['repository.job']->findAll();
            $response = $app['twig']->render('person/person_view.html.twig', array(
                'person' => $person,
                'items' => $items,
                'jobs' => $jobs
            ));
        } else {
            $response = $this->redirectOnInvalidId($app, $id);
        }

        return $response;
    }

    /**
     * @param Application $app
     * @param $id
     * @return RedirectResponse
     */
    private function redirectOnInvalidId(Application $app, $id)
    {
        $message = "There is no record for ID " . $id;
        $app['session']->getFlashBag()->add('danger', $message);
        return $app->redirect($app['url_generator']->generate('people'));
    }

    /**
     * @param Request $request
     * @param Application $app
     * @return RedirectResponse
     */
    public function saveAction(Request $request, Application $app)
    {

        $firstName = $request->get('firstName');
        $lastName = $request->get('lastName');
        if ($id = $request->get('id')) {
            /** @var Person $person */
            $person = $this->personRepository->find($id);
            $person->setFirstName($firstName);
            $person->setLastName($lastName);
            $email = $request->get('email');
            $person->setEmail($email);
            $gender = $request->get('gender');
            $person->setGender($gender);
//            $startDate = $request->get('startDate');
//            $person->setStartDate($startDate);
//            $endDate = $request->get('endDate');
//            $person->setEndDate($endDate);
            $birthLocality = $request->get('birthLocality');
            $person->setBirthLocality($birthLocality);
            $birthProvince = $request->get('birthProvince');
            $person->setBirthProvince($birthProvince);
            $job = $app['repository.job']->Find($request->get('jobId'));
            $person->setJob($job);

        } else {
            $data = array(
                'firstName' => $firstName,
                'lastName' => $lastName,
                'startDate' => new \DateTime(),
            );
            $person = new Person($data);
        }
        $this->personRepository->save($person);

        // TODO: Check for failure or success

        $redirect = $app['url_generator']->generate('person_view', array('id' => $id));
        return $app->redirect($redirect);
    }

    /**
     * @param Application $app
     * @return Response
     */
    public function addAction(Application $app)
    {
        return $app['twig']->render('person/person_add.html.twig');
    }

    /**
     * @param Application $app
     * @param $id Person id
     * @return Response/ResponseRedirect
     */
    public function editAction(Application $app, $id)
    {
        /** @var Person $person */
        $person = $this->personRepository->find($id);
        if ($person) {
            $items = $person->getItems();
            $jobs = $app['repository.job']->findAll();
            $response = $app['twig']->render('person/person_edit.html.twig', array(
                'person' => $person,
                'items' => $items,
                'jobs' => $jobs));
        } else {
            $response = $this->redirectOnInvalidId($app, $id);
        }
        return $response;
    }

    /**
     * @param Request $request
     * @param Application $app
     * @return RedirectResponse
     */
    public function deleteAction(Request $request, Application $app)
    {
        $id = $request->get('id');
        /** @var Person $person */
        $person = $this->personRepository->find($id);
        if ($person) {
            $this->personRepository->delete($person);
            $response = $app->redirect($app['url_generator']->generate('people'));
        } else {
            $response = $this->redirectOnInvalidId($app, $id);
        }

        return $response;
    }

    /**
     * @param Request $request
     * @param Application $app
     * @return Response/ResponseRedirect
     */
    public function photoEditAction(Request $request, Application $app)
    {
        $id = $request->get('id');
        /** @var Person $person */
        $person = $this->personRepository->find($id);
        if ($person) {
            $response = $app['twig']->render('person/photo_edit.html.twig', array(
                'person' => $person,
            ));
        } else {
            $response = $this->redirectOnInvalidId($app, $id);
        }

        return $response;
    }

    public function photoSaveAction(Request $request, Application $app)
    {
        $personId = $request->get('id_person');
        $imageBase64 = $request->get('image');
//        $personId = filter_input(INPUT_POST, 'id_person', FILTER_SANITIZE_NUMBER_INT);
//        $imageBase64 = filter_input(INPUT_POST, 'image');

        if ($personId && $imageBase64) {
            $filename = CC_DIR_PRIVATE_UPLOAD . CC_DIR_FOTO_PERSONA . $personId . ".jpg";
            // Extract the string "data:image/jpeg;base64," from $imageBase64
            $imageBase64Exploded = explode(',', $imageBase64);
            $imageString = $imageBase64Exploded[1];
            file_put_contents($filename, base64_decode($imageString));
            $redirect = $app['url_generator']->generate('person_edit', array('id' => $personId));

            $location = "index.php?page=person/person_editar&id=$personId";
        } else {
            $redirect = $app['url_generator']->generate('person_edit', array('id' => $personId));
            $message = "Faltan datos.";
            $location = "index.php?page=person/person_editar&id=$personId&mensaje=$message";
        }
        $response = $app->redirect($redirect);
        return $response;


    }

}