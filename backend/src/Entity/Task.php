<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Entité représentant une tâche dans l'application
 */
#[ORM\Entity(repositoryClass: TaskRepository::class)]
class Task
{
    /**
     * Identifiant unique de la tâche
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * Titre de la tâche
     */
    #[ORM\Column(length: 255)]
    private ?string $title = null;

    /**
     * Description de la tâche
     */
    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    /**
     * Statut  de la tâche
     */
    #[ORM\Column(length: 255)]
    private ?string $status = null;

    /**
     * Récupère l'identifiant de la tâche
     * 
     * @return int|null L'identifiant de la tâche
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Récupère le titre de la tâche
     * 
     * @return string|null Le titre de la tâche
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Définit le titre de la tâche
     * 
     * @param string $title Le nouveau titre
     * @return static
     */
    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Récupère la description de la tâche
     * 
     * @return string|null La description de la tâche
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Définit la description de la tâche
     * 
     * @param string $description La nouvelle description
     * @return static
     */
    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Récupère le statut de la tâche
     * 
     * @return string|null Le statut de la tâche
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * Définit le statut de la tâche
     * 
     * @param string $status Le nouveau statut
     * @return static
     */
    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }
}
