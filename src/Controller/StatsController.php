<?php

namespace App\Controller;
use App\Entity\Stats;
use App\Exception\InvalidFormException;
use App\Handler\StatsHandler;
use App\Transformer\StatsTransformer;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/stats")
 */
class StatsController extends AbstractController
{

    public function __construct(
        private StatsHandler $statsHandler,
        private StatsTransformer $statsTransformer
    )
    {

    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws InvalidFormException
     * @Route ("",methods={"POST"})
     */
    public function createStatsAction (Request $request):JsonResponse
    {
          $stats= $this->statsHandler->create($request->request->all());
          return new JsonResponse($this->statsTransformer->transform($stats),Response::HTTP_CREATED);

    }

    /**
     * @Route("/{statsId}", methods={"PATCH"})
     * @param Request $request
     * @param Stats $stats
     * @return JsonResponse
     * @ParamConverter("stats", options={"id" = "statsId"})
     */
    public function updateShowAction(Request $request, Stats $stats): JsonResponse
    {
        $stats = $this->statsHandler->update($stats, $request->request->all());
        $statsArray = $this->statsTransformer->transform($stats);
        return new JsonResponse($statsArray, Response::HTTP_OK);

    }

    /**
     * @param Stats $stats
     * @return JsonResponse
     * @throws ORMException
     * @throws OptimisticLockException
     * @Route("/{statsId}", methods={"DELETE"})
     *@ParamConverter("stats", options={"id" = "statsId"})
     */
    public function deleteShowAction( Stats $stats): JsonResponse
    {
        $this->statsHandler->delete($stats);
        return new JsonResponse(null,Response::HTTP_NO_CONTENT);
    }


}