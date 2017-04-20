<?php

namespace US\Cultus\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use US\Cultus\Entity\Taller\Sesion;
use US\Cultus\Entity\Taller\Taller;
use US\Cultus\Repository\SesionRepository;



class ApiSesionController
{
    /**
     * @var sesionRepository
     */
    protected $sesionRepository;

    /**
     * @param SesionRepository $sesionRepository
     */
    function __construct(SesionRepository $sesionRepository)
    {
        $this->sesionRepository = $sesionRepository;
    }

    /**
     * @param Application $app
     * @param integer $taller_id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function indexAction(Application $app, $taller_id)
    {
        /** @var Taller $taller */
        $taller = $app['repository.taller']->find($taller_id);
        $sesiones = $taller->getSesiones();
        $data = array();
        foreach ($sesiones as $sesion) {
            $data[] = array(
                'id' => $sesion->getId(),
                'duracion' => $sesion->getDuracion(),
                'fecha' => $sesion->getFecha(),
                'horaInicio' => $sesion->getHoraInicio(),
                'observaciones' => $sesion->getObservaciones(),
            );
        }

        return $app->json($data);
    }

    /**
     * @param Application $app
     * @param integer $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function viewAction(Application $app, $id)
    {
        $sesion = $this->sesionRepository->find($id);
        if (!$sesion) {
            return $app->json('Not Found', 404);
        }
        $data = array(
            'id' => $sesion->getId(),
            'duracion' => $sesion->getDuracion(),
            'fecha' => $sesion->getFecha(),
            'horaInicio' => $sesion->getHoraInicio(),
            'observaciones' => $sesion->getObservaciones(),
        );

        return $app->json($data);
    }

    /**
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function addAction(Request $request, Application $app)
    {
        if (!$request->request->has('duracion')) {
            return $app->json('Falta dato necesario: duracion', 400);
        }
        if (!$request->request->has('fecha')) {
            return $app->json('Falta dato necesario: fecha', 400);
        }
        if (!$request->request->has('horaInicio')) {
            return $app->json('Falta dato necesario: horaInicio', 400);
        }
        $sesion = new Sesion();
        $sesion->setDuracion($request->request->get('duracion'));
        $sesion->setFecha($request->request->get('fecha'));
        $sesion->setHoraInicio($request->request->get('horaInicio'));
        $sesion->setObservaciones($request->request->get('observaciones'));
        $this->sesionRepository->save($sesion);

        $headers = array('Location' => '/api/sesion/' . $sesion->getId());
        return $app->json('Created', 201, $headers);
    }

    /**
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function editAction(Request $request, Application $app)
    {
        $sesion = $request->attributes->get('sesion');
        if (!$sesion) {
            return $app->json('Not Found', 404);
        }
        if (!$request->request->has('duracion')) {
            return $app->json('Falta dato necesario: duracion', 400);
        }
        if (!$request->request->has('fecha')) {
            return $app->json('Falta dato necesario: fecha', 400);
        }
        if (!$request->request->has('horaInicio')) {
            return $app->json('Falta dato necesario: horaInicio', 400);
        }
        $sesion->setDuracion($request->request->get('duracion'));
        $sesion->setFecha($request->request->get('fecha'));
        $sesion->setHoraInicio($request->request->get('horaInicio'));
        $sesion->setObservaciones($request->request->get('observaciones'));
        $this->sesionRepository->save($sesion);

        return $app->json('OK', 200);
    }

    /**
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function deleteAction(Request $request, Application $app)
    {
        $sesion = $request->attributes->get('sesion');
        if (!$sesion) {
            return $app->json('Not Found', 404);
        }
        $this->sesionRepository->delete($sesion);

        return $app->json('No Content', 204);
    }
}