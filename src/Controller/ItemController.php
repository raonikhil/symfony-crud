<?php

namespace App\Controller;
use App\Entity\Item;
use App\Repository\ItemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ItemController extends AbstractController
{
    public function home()
    {
        return $this->render('home/index.html.twig');

    }

    public function index(ItemRepository $itemRepository)
    {
        $items = $itemRepository->transformAll();

        return new JsonResponse($items, 200);
    }

    public function create(Request $request, ItemRepository $itemRepository, EntityManagerInterface $em)
    {
        $request = json_decode($request->getContent(), true);
        if (!$request) {
            return new JsonResponse('invalid request', 200);
        }

        if (!$request['name']) {
            return new JsonResponse('Name required', 200);
        }

        $item = new Item;
        $item->setName($request['name']);
        $em->persist($item);
        $em->flush();

        return new JsonResponse($itemRepository->transform($item), 201);
    }
}