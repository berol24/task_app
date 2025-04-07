<?php

namespace App\Controller;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;



final class TaskController extends AbstractController
{
    /**
     * Crée une nouvelle tâche
     * 
     * @param Request $request La requête HTTP contenant les données de la tâche
     * @param EntityManagerInterface $entityManager Le gestionnaire d'entités Doctrine
     * @return JsonResponse La réponse JSON avec le message de confirmation
     */
    #[Route('/tasks', name: 'create_task', methods: ['POST'])]
    public function createTask(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        // Récupérer les données de la requête
        $data = json_decode($request->getContent(), true);
    
        // Créer une nouvelle instance de Task
        $task = new Task();
        $task->setTitle($data['title']);
        $task->setDescription($data['description']);
        $task->setStatus($data['status']);
    
        // Enregistrer dans la base de données
        $entityManager->persist($task);
        $entityManager->flush();
    
        return new JsonResponse(['message' => 'Task created successfully'], Response::HTTP_CREATED);
    }
    
    /**
     * Récupère toutes les tâches
     * 
     * @param TaskRepository $taskRepository Le repository des tâches
     * @return JsonResponse La liste des tâches au format JSON
     */
    #[Route('/tasks', name: 'get_tasks', methods: ['GET'])]
    public function getTasks(TaskRepository $taskRepository): JsonResponse
    {
        // Récupérer toutes les tâches
        $tasks = $taskRepository->findAll();
        
        // Transformer les objets Task en tableau
        $taskArray = array_map(function ($task) {
            return [
                'id' => $task->getId(),
                'title' => $task->getTitle(),
                'description' => $task->getDescription(),
                'status' => $task->getStatus(),
            ];
        }, $tasks);

        return new JsonResponse($taskArray, Response::HTTP_OK);
    }

    /**
     * Met à jour une tâche existante
     * 
     * @param int $id L'identifiant de la tâche
     * @param Request $request La requête HTTP contenant les données à mettre à jour
     * @param TaskRepository $taskRepository Le repository des tâches
     * @param EntityManagerInterface $entityManager Le gestionnaire d'entités Doctrine
     * @return JsonResponse La réponse JSON avec le message de confirmation
     */
    #[Route('/tasks/{id}', name: 'update_task', methods: ['PUT'])]
    public function updateTask(int $id, Request $request, TaskRepository $taskRepository, EntityManagerInterface $entityManager): JsonResponse
    {
        // Rechercher la tâche par son ID
        $task = $taskRepository->find($id);
        if (!$task) {
            return new JsonResponse(['error' => 'Task not found'], Response::HTTP_NOT_FOUND);
        }

        // Récupérer les données de la requête
        $data = json_decode($request->getContent(), true);

        // Mettre à jour les champs si présents dans la requête
        if (isset($data['title'])) {
            $task->setTitle($data['title']);
        }

        if (isset($data['description'])) {
            $task->setDescription($data['description']);
        }

        if (isset($data['status'])) {
            $task->setStatus($data['status']);
        }

        // Sauvegarder les modifications
        $entityManager->flush();

        return new JsonResponse(['message' => 'Task fully updated successfully'], Response::HTTP_OK);
    }

    /**
     * Supprime une tâche
     * 
     * @param int $id L'identifiant de la tâche à supprimer
     * @param TaskRepository $taskRepository Le repository des tâches
     * @param EntityManagerInterface $entityManager Le gestionnaire d'entités Doctrine
     * @return JsonResponse La réponse JSON avec le message de confirmation
     */
    #[Route('/tasks/{id}', name: 'delete_task', methods: ['DELETE'])]
    public function deleteTask(int $id, TaskRepository $taskRepository, EntityManagerInterface $entityManager): JsonResponse
    {
        // Rechercher la tâche par son ID
        $task = $taskRepository->find($id);
        if (!$task) {
            return new JsonResponse(['error' => 'Task not found'], Response::HTTP_NOT_FOUND);
        }

        // Supprimer la tâche
        $entityManager->remove($task);
        $entityManager->flush();

        return new JsonResponse(['message' => 'Task deleted successfully'], Response::HTTP_OK);
    }
}
