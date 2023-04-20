<?php

namespace App\Controller;

use App\Entity\Warehouse;
use App\Form\WarehouseType;
use App\Repository\WarehouseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/dashboard/warehouse')]
class WarehouseController extends AbstractController
{
    #[Route('/', name: 'app_warehouse_index', methods: ['GET'])]
    public function index(WarehouseRepository $warehouseRepository): Response
    {
        return $this->render('warehouse/index.html.twig', [
            'warehouses' => $warehouseRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_warehouse_new', methods: ['GET', 'POST'])]
    public function new(Request $request, WarehouseRepository $warehouseRepository): Response
    {
        $warehouse = new Warehouse();
        $form = $this->createForm(WarehouseType::class, $warehouse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $warehouseRepository->save($warehouse, true);

            return $this->redirectToRoute('app_warehouse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('warehouse/new.html.twig', [
            'warehouse' => $warehouse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_warehouse_show', methods: ['GET'])]
    public function show(Warehouse $warehouse): Response
    {
        return $this->render('warehouse/show.html.twig', [
            'warehouse' => $warehouse,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_warehouse_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Warehouse $warehouse, WarehouseRepository $warehouseRepository): Response
    {
        $form = $this->createForm(WarehouseType::class, $warehouse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $warehouseRepository->save($warehouse, true);

            return $this->redirectToRoute('app_warehouse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('warehouse/edit.html.twig', [
            'warehouse' => $warehouse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_warehouse_delete', methods: ['POST'])]
    public function delete(Request $request, Warehouse $warehouse, WarehouseRepository $warehouseRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$warehouse->getId(), $request->request->get('_token'))) {
            $warehouseRepository->remove($warehouse, true);
        }

        return $this->redirectToRoute('app_warehouse_index', [], Response::HTTP_SEE_OTHER);
    }
}
