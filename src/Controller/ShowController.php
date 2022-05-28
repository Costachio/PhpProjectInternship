<?php

namespace App\Controller;
use App\Entity\Show;
use App\Entity\Stats;
use App\Handler\ShowHandler;
use App\Repository\ShowRepository;
use App\Transformer\ShowTransformer;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route ("/show")
 */
class ShowController extends AbstractController
{

    public function __construct(
        private ShowHandler $showHandler,
        private ShowRepository $showRepository,
        private ShowTransformer $showTransformer
    )
    {}

    /**
     * @param Request $request
     * @Route ("",methods={"POST"})
     */

    public function createShowAction(Request $request)
    {
        $show =$this->showHandler->create($request->request->all());
        $showArray= $this->showTransformer->transform($show);

        return new JsonResponse($showArray, Response::HTTP_CREATED);
    }
    /**
     * @Route ("/all",methods={"GET"})
     */
    public function getAllShows(): JsonResponse
    {
        $shows=$this->showRepository->findAll();
        $showsArray=$this->showTransformer->transformList($shows);
        return new JsonResponse($showsArray, Response::HTTP_OK);
    }

    /**
     * @Route("/{showId}/{statsId}", methods={"PATCH"})
     * @param Request $request
     * @param Show $show
     * @param  Stats $stats
     * @return JsonResponse
     * @ParamConverter("show", options={"id" = "showId"})
     * @ParamConverter("stats", options={"id" = "statsId"})
     */
    public function updateShowAction(Request $request, Show $show, Stats $stats): JsonResponse
    {
        $show = $this->showHandler->update($show, $request->request->all());
        $showArray = $this->showTransformer->transform($show);
        return new JsonResponse($showArray, Response::HTTP_OK);

    }

    /**
     * @param Show $show
     * @return JsonResponse
     * @throws ORMException
     * @throws OptimisticLockException
     * @Route("/{showId}", methods={"DELETE"})
     *@ParamConverter("show", options={"id" = "showId"})
     */
    public function deleteShowAction( Show $show): JsonResponse
    {
        $this->showHandler->delete($show);
        return new JsonResponse(null,Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/{showId}", methods={"GET"})
     * @param Show $show
     * @return JsonResponse
     *@ParamConverter("show", options={"id" = "showId"})
     */
    public function getShowAction(Show $show): JsonResponse
    {
        $showArray = $this->showTransformer->transform($show);
        return new JsonResponse($showArray, Response::HTTP_OK);

    }






}