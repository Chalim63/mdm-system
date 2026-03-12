<?php

namespace App\Controller;

use App\Entity\Device;
use App\Form\DeviceType;
use App\Repository\DeviceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/device')]
final class DeviceController extends AbstractController
{
    #[Route(name: 'app_device_index', methods: ['GET'])]
    public function index(Request $request, DeviceRepository $deviceRepository): Response
    {
    $search = $request->query->get('q');
    $sort = $request->query->get('sort', 'id');
    $direction = $request->query->get('direction', 'asc');

    $devices = $deviceRepository->findBySearchAndSort($search, $sort, $direction);

    return $this->render('device/index.html.twig', [
        'devices' => $devices,
        'search' => $search,
        'sort' => $sort,
        'direction' => $direction,
    ]);
    }

    #[Route('/new', name: 'app_device_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $device = new Device();
        $form = $this->createForm(DeviceType::class, $device);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $device->setCreatedAt(new \DateTimeImmutable());
            $device->setLastUpd(new \DateTimeImmutable());
            $entityManager->persist($device);
            $entityManager->flush();

            return $this->redirectToRoute('app_device_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('device/new.html.twig', [
            'device' => $device,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_device_show', methods: ['GET'])]
    public function show(Device $device): Response
    {
        return $this->render('device/show.html.twig', [
            'device' => $device,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_device_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Device $device, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DeviceType::class, $device);
        $form->handleRequest($request);

        

        if ($form->isSubmitted() && $form->isValid()) {

            $device->setLastUpd(new \DateTimeImmutable());    

            $entityManager->flush();

            return $this->redirectToRoute('app_device_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('device/edit.html.twig', [
            'device' => $device,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_device_delete', methods: ['POST'])]
    public function delete(Request $request, Device $device, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$device->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($device);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_device_index', [], Response::HTTP_SEE_OTHER);
    }

}
