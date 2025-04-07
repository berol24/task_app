import React from "react";

// affichage de liste des tâches
const TaskList = ({ tasks, deleteTask, handleUpdateClick }) => {
  return (
    <div className="list-group">
      {tasks.map((task, index) => (
        <div
          key={`task-${task.id || index}`}
          className="list-group-item d-flex justify-content-between align-items-center"
        >
          <div>
            <h5 className="mb-1">{task.title}</h5>
            <p className="mb-1">{task.description}</p>
            <span
              className={`badge ${
                task.status === "completed"
                  ? "bg-success"
                  : task.status === "in_progress"
                  ? "bg-warning"
                  : "bg-secondary"
              }`}
            >
              {task.status === "pending"
                ? "En attente"
                : task.status === "in_progress"
                ? "En cours"
                : "Terminé"}
            </span>
          </div>
          <div>
            <button
              className="btn btn-sm btn-outline-danger me-2"
              onClick={() => deleteTask(task.id)}
            >
              Supprimer
            </button>
            <button
              className="btn btn-sm btn-outline-primary"
              onClick={() => handleUpdateClick(task)}
            >
              Modifier
            </button>
          </div>
        </div>
      ))}
    </div>
  );
};

export default TaskList;
