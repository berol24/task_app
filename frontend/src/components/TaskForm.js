import React from "react";

// Composant pour le formulaire de création de tâche
const TaskForm = ({ newTask, setNewTask, createTask }) => {
  return (
    <div className="card mb-4 p-4">
      <div className="row g-3">
        <div className="col-md-4">
          <input
            className="form-control"
            value={newTask.title}
            onChange={(e) => setNewTask({ ...newTask, title: e.target.value })}
            placeholder="Titre de la tâche"
          />
        </div>
        <div className="col-md-4">
          <input
            className="form-control"
            value={newTask.description}
            onChange={(e) =>
              setNewTask({ ...newTask, description: e.target.value })
            }
            placeholder="Description de la tâche"
          />
        </div>
        <div className="col-md-2">
          <select
            className="form-select"
            value={newTask.status}
            onChange={(e) => setNewTask({ ...newTask, status: e.target.value })}
          >
            <option value="pending">En attente</option>
            <option value="in_progress">En cours</option>
            <option value="completed">Terminé</option>
          </select>
        </div>
        <div className="col-md-2">
          <button className="btn btn-primary w-100" onClick={createTask}>
            Ajouter
          </button>
        </div>
      </div>
    </div>
  );
};

export default TaskForm;
