<?php

namespace App\Presentation\Web\Controller;

use App\Core\Application\Service\PortfolioService;
use App\Core\Domain\Model\Portfolio\Portfolio;
use App\Core\Domain\Repository\UserRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/portfolios", name="web_portfolio_")
 */
final class PortfolioController extends AbstractController
{
    /**
     * @var PortfolioService
     */
    private $service;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(PortfolioService $service, UserRepositoryInterface $userRepository)
    {
        $this->service = $service;
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("", name="list", methods={"GET"})
     */
    public function list()
    {
        $user = $this->userRepository->findOneByEmail('test.name.three@example.com');
        $portfolios = $this->service->fetchAllForUser($user);

        return $this->render('@Web/portfolio/list.html.twig', [
            'portfolios' => $portfolios,
        ]);
    }

    /**
     * @Route(
     *      "/{id}",
     *      name="show",
     *      methods={"GET"},
     *      requirements={"id"="\d+"}
     * )
     */
    public function show(Portfolio $portfolio)
    {
        return $this->render('@Web/portfolio/show.html.twig', [
            'portfolio' => $portfolio,
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET", "POST"})
     */
    public function new()
    {
        return $this->render('@Web/edit.html.twig');
    }

    // /**
    //  * @Route(
    //  *      "/{id}/edit",
    //  *      name="edit",
    //  *      methods={"POST", "GET"},
    //  *      requirements={"id"="\d+"}
    //  * )
    //  */
    // public function edit(Portfolio $portfolio)
    // {
    //     return $this->render('@Web/home.html.twig');
    // }

    // /**
    //  * @Route(
    //  *      "/{id}/deactivate",
    //  *      name="deactivate",
    //  *      methods={"POST"},
    //  *      requirements={"id"="\d+"}
    //  * )
    //  */
    // public function deactivate(Portfolio $portfolio)
    // {
    //     return $this->render('@Web/home.html.twig');
    // }

    // /**
    //  * @Route(
    //  *      "/{id}/activate",
    //  *      name="activate",
    //  *      methods={"POST"},
    //  *      requirements={"id"="\d+"}
    //  * )
    //  */
    // public function activate(Portfolio $portfolio)
    // {
    //     return $this->render('@Web/home.html.twig');
    // }
}
