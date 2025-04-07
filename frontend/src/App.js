// Import des dépendances nécessaires
import React, { useState, useEffect } from "react";
import axios from "axios";
import TaskForm from "./components/TaskForm";
import TaskList from "./components/TaskList";
import TaskModal from "./components/TaskModal";

const App = () => {

  const ApiUrl = "http://localhost:8000";
  const [tasks, setTasks] = useState([]); 
  const [loading, setLoading] = useState(true); 
  const [showUpdateModal, setShowUpdateModal] = useState(false); 
  const [selectedTask, setSelectedTask] = useState(null); 
  const [message, setMessage] = useState(""); 
  const [newTask, setNewTask] = useState({
    title: "",
    description: "",
    status: "pending",
  }); // Nouvelle tâche à créer


  useEffect(() => {
    fetchTasks();
  }, []);

  // Affiche un message pendant 3 secondes
  const showTemporaryMessage = (msg) => {
    setMessage(msg);
    setTimeout(() => {
      setMessage("");
    }, 3000);
  };

  // Récupère toutes les tâches
  const fetchTasks = async () => {
    try {
      const response = await axios.get(`${ApiUrl}/tasks`);
      setTasks(response.data);
      setLoading(false);
    } catch (error) {
      console.error("Erreur lors du chargement des tâches:", error);
      setLoading(false);
    }
  };

  // Crée une nouvelle tâche
  const createTask = async () => {
    try {
      const response = await axios.post(`${ApiUrl}/tasks`, newTask);
      setTasks([...tasks, response.data]);
      setNewTask({ title: "", description: "", status: "pending" });
      showTemporaryMessage("Tâche ajoutée avec succès !");
      fetchTasks();
    } catch (error) {
      console.error("Erreur lors de la création de la tâche:", error);
    }
  };

  // Supprime une tâche existante
  const deleteTask = async (taskId) => {
    try {
      await axios.delete(`${ApiUrl}/tasks/${taskId}`);
      setTasks(tasks.filter((task) => task.id !== taskId));
      showTemporaryMessage("Tâche supprimée avec succès !");
      fetchTasks();
    } catch (error) {
      console.error("Erreur lors de la suppression de la tâche:", error);
    }
  };

  // Met à jour une tâche existante
  const updateTask = async (taskId, updatedTask) => {
    try {
      const response = await axios.put(
        `${ApiUrl}/tasks/${taskId}`,
        updatedTask
      );
      setTasks(
        tasks.map((task) => (task.id === taskId ? response.data : task))
      );
      setShowUpdateModal(false);
      showTemporaryMessage("Tâche mise à jour avec succès !");
      fetchTasks();
    } catch (error) {
      console.error("Erreur lors de la mise à jour de la tâche:", error);
    }
  };

  // Gère le clic sur le bouton de mise à jour
  const handleUpdateClick = (task) => {
    setSelectedTask(task);
    setShowUpdateModal(true);
  };

 
  return (
    <div className="container py-5">
      <h1 className="text-center mb-5">Gestionnaire de Tâches Edreams Factory</h1>
      {message && (
        <div className="alert alert-success text-center mb-4" role="alert">
          {message}
        </div>
      )}
      <TaskForm
        newTask={newTask}
        setNewTask={setNewTask}
        createTask={createTask}
      />
      {loading ? (
        <div className="text-center">
          <div className="spinner-border text-primary" role="status">
            <span className="visually-hidden">Chargement en cours...</span>
          </div>
        </div>
      ) : (
        <TaskList
          tasks={tasks}
          deleteTask={deleteTask}
          handleUpdateClick={handleUpdateClick}
        />
      )}
      {showUpdateModal && selectedTask && (
        <TaskModal
          task={selectedTask}
          setTask={setSelectedTask}
          updateTask={updateTask}
          closeModal={() => setShowUpdateModal(false)}
        />
      )}
    </div>
  );
};

export default App;