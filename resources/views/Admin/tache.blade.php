<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kanban Board - Modern Design</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('asset/css/style.css')}}">
    <style>
        /* Styles pour les modales modernes */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        
        .modal.active {
            display: flex;
        }
        
        .modal-content {
            background-color: var(--modal-bg);
            padding: 2rem;
            border-radius: 10px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            transform: translateY(-50px);
            opacity: 0;
            transition: all 0.3s ease;
        }
        
        .modal.active .modal-content {
            transform: translateY(0);
            opacity: 1;
        }
        
        .modal-header {
            margin-bottom: 1.5rem;
            position: relative;
        }
        
        .modal-close {
            position: absolute;
            top: -10px;
            right: -10px;
            background: var(--danger);
            color: white;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1rem;
        }
        
        /* Style pour les tâches en cours de drag */
        .task.dragging {
            opacity: 0.5;
            transform: rotate(3deg);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        /* Style pour les colonnes pendant le drag */
        .column.highlight {
            background-color: var(--column-highlight);
            transition: background-color 0.3s;
        }
        
        /* Variables CSS pour le thème */
        :root {
            --modal-bg: #ffffff;
            --column-highlight: rgba(200, 200, 255, 0.3);
            --danger: #e74c3c;
        }
        
        .dark-mode {
            --modal-bg: #2d3436;
            --column-highlight: rgba(44, 62, 80, 0.5);
        }

        footer {
    text-align: center;
    padding: 10px;
    font-size: 14px;

    color: var(--footer-color, #555);
}


    </style>
</head>

<body class="{{ session('theme', 'light') === 'dark' ? 'dark-mode' : 'light-mode' }}">
    <div class="container">
        <header>
            <h1>Bonjour {{ $user->name }}</h1>

            
            <p class="subtitle">Organisez vos tâches efficacement</p>
            <button class="theme-toggle" id="theme-toggle">
                <span id="theme-icon">{{ session('theme', 'light') === 'dark' ? '☀️' : '🌙' }}</span>
                <span id="theme-text">{{ session('theme', 'light') === 'dark' ? 'Light Mode' : 'Dark Mode' }}</span>
            </button>
        </header>

        <div class="board">
            <!-- Colonne To Do -->
            <div class="column todo" data-status="todo">
                <div class="column-header">
                    <div class="column-title">
                        <span>À Faire</span>
                    
                    </div>
                    <button class="add-task" data-column="todo">+</button>
                </div>
                <div class="tasks" id="todo-tasks">
                    @foreach($todoTasks as $task)
                    <div class="task todo" draggable="true" data-id="{{ $task->id }}">
                        <h3 class="task-title">{{ $task->title }}</h3>
                        <p class="task-description">{{ $task->description }}</p>
                        <div class="task-footer">
                            <span class="task-date">{{ $task->due_date ? $task->due_date->format('d/m/Y') : 'Aucune date' }}</span>
                            <div class="task-actions">
                                <button class="task-btn edit-task" data-id="{{ $task->id }}">✏️</button>
                                <button class="task-btn delete-task" data-id="{{ $task->id }}">🗑️</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Colonne En Cours -->
            <div class="column progress" data-status="progress">
                <div class="column-header">
                    <div class="column-title">
                        <span>En Cours</span>
                   
                    </div>
                    <button class="add-task" data-column="progress">+</button>
                </div>
                <div class="tasks" id="progress-tasks">
                    @foreach($progressTasks as $task)
                    <div class="task progress" draggable="true" data-id="{{ $task->id }}">
                        <h3 class="task-title">{{ $task->title }}</h3>
                        <p class="task-description">{{ $task->description }}</p>
                        <div class="task-footer">
                            <span class="task-date">{{ $task->due_date ? $task->due_date->format('d/m/Y') : 'En cours' }}</span>
                            <div class="task-actions">
                                <button class="task-btn edit-task" data-id="{{ $task->id }}">✏️</button>
                                <button class="task-btn delete-task" data-id="{{ $task->id }}">🗑️</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Colonne Terminé -->
            <div class="column done" data-status="done">
                <div class="column-header">
                    <div class="column-title">
                        <span>Terminé</span>
                     
                    </div>
                    <button class="add-task" data-column="done">+</button>
                </div>
                <div class="tasks" id="done-tasks">
                    @foreach($doneTasks as $task)
                    <div class="task done" draggable="true" data-id="{{ $task->id }}">
                        <h3 class="task-title">{{ $task->title }}</h3>
                        <p class="task-description">{{ $task->description }}</p>
                        <div class="task-footer">
                            <span class="task-date">{{ $task->due_date ? $task->due_date->format('d/m/Y') : 'Terminé' }}</span>
                            <div class="task-actions">
                                <button class="task-btn edit-task" data-id="{{ $task->id }}">✏️</button>
                                <button class="task-btn delete-task" data-id="{{ $task->id }}">🗑️</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pour ajouter/modifier une tâche -->
    <div class="modal" id="task-modal">
        <div class="modal-content">
            <button class="modal-close" id="close-modal">×</button>
            <div class="modal-header">
                <h2 class="modal-title" id="modal-title">Ajouter une nouvelle tâche</h2>
            </div>
            <form id="task-form" method="POST" action="{{ route('tasks.store') }}">
                @csrf
                <input type="hidden" id="task-id" name="id">
                <input type="hidden" id="task-column" name="status">
                <div class="form-group">
                    <label for="task-title" class="form-label">Titre</label>
                    <input type="text" id="task-title" name="title" class="form-input" placeholder="Nom de la tâche" required>
                </div>
                <div class="form-group">
                    <label for="task-description" class="form-label">Description</label>
                    <textarea id="task-description" name="description" class="form-input form-textarea" placeholder="Détails de la tâche..."></textarea>
                </div>
                <div class="form-group">
                    <label for="task-date" class="form-label">Date limite</label>
                    <input type="date" id="task-date" name="due_date" class="form-input">
                </div>
                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" id="cancel-task">Annuler</button>
                    <button type="submit" class="btn btn-primary" id="save-task-btn">Ajouter la tâche</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal de confirmation pour la suppression -->
    <div class="modal" id="confirm-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Confirmation</h2>
                <button class="modal-close" id="close-confirm-modal">×</button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer cette tâche?</p>
            </div>
            <div class="form-actions">
                <button class="btn btn-secondary" id="cancel-delete">Annuler</button>
                <form id="delete-form" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" id="confirm-delete">Supprimer</button>
                </form>
            </div>
        </div>
    </div>

   <footer style="text-align: center;margin-top:30px; padding: 2px; font-size: 12px; color: #555;">
    © 2025 ToDo List. Tous droits réservés. Développé par {{$user->name}}.

</footer>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gestion du thème dark/light
            const themeToggle = document.getElementById('theme-toggle');
            const themeIcon = document.getElementById('theme-icon');
            const themeText = document.getElementById('theme-text');
            const body = document.body;
            
            themeToggle.addEventListener('click', () => {
                if (body.classList.contains('light-mode')) {
                    body.classList.replace('light-mode', 'dark-mode');
                    themeIcon.textContent = '☀️';
                    themeText.textContent = 'Light Mode';
                    // Enregistrer la préférence côté client
                    localStorage.setItem('theme', 'dark');
                } else {
                    body.classList.replace('dark-mode', 'light-mode');
                    themeIcon.textContent = '🌙';
                    themeText.textContent = 'Dark Mode';
                    localStorage.setItem('theme', 'light');
                }
            });

            // Gestion des modales
            const modal = document.getElementById('task-modal');
            const confirmModal = document.getElementById('confirm-modal');
            const openModalButtons = document.querySelectorAll('.add-task');
            const closeModalButton = document.getElementById('close-modal');
            const closeConfirmModalButton = document.getElementById('close-confirm-modal');
            const cancelButton = document.getElementById('cancel-task');
            const cancelDeleteButton = document.getElementById('cancel-delete');
            const taskForm = document.getElementById('task-form');
            const deleteForm = document.getElementById('delete-form');
            const taskIdInput = document.getElementById('task-id');
            const taskColumnInput = document.getElementById('task-column');
            const taskTitleInput = document.getElementById('task-title');
            const taskDescriptionInput = document.getElementById('task-description');
            const taskDateInput = document.getElementById('task-date');
            const modalTitle = document.getElementById('modal-title');
            const saveTaskButton = document.getElementById('save-task-btn');
            
            // Ouvrir le modal pour ajouter une tâche
            openModalButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const column = button.getAttribute('data-column');
                    taskIdInput.value = '';
                    taskColumnInput.value = column;
                    taskForm.reset();
                    taskForm.action = "{{ route('tasks.store') }}";
                    taskForm.querySelector('input[name="_method"]')?.remove();
                    modalTitle.textContent = 'Ajouter une nouvelle tâche';
                    saveTaskButton.textContent = 'Ajouter la tâche';
                    modal.classList.add('active');
                });
            });
            
            // Ouvrir le modal pour éditer une tâche
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('edit-task')) {
                    const taskId = e.target.getAttribute('data-id');
                    const taskElement = document.querySelector(`.task[data-id="${taskId}"]`);
                    
                    // Remplir le formulaire avec les données de la tâche
                    taskIdInput.value = taskId;
                    taskColumnInput.value = taskElement.parentElement.parentElement.getAttribute('data-status');
                    taskTitleInput.value = taskElement.querySelector('.task-title').textContent;
                    taskDescriptionInput.value = taskElement.querySelector('.task-description').textContent;
                    
                    // Formater la date pour l'input date
                    const dateText = taskElement.querySelector('.task-date').textContent;
                    if (dateText && dateText !== 'Aucune date' && dateText !== 'En cours' && dateText !== 'Terminé') {
                        const [day, month, year] = dateText.split('/');
                        taskDateInput.value = `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;
                    } else {
                        taskDateInput.value = '';
                    }
                    
                    // Configurer le formulaire pour la mise à jour
                    taskForm.action = `/tasks/${taskId}`;
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'PUT';
                    taskForm.appendChild(methodInput);
                    
                    modalTitle.textContent = 'Modifier la tâche';
                    saveTaskButton.textContent = 'Mettre à jour';
                    modal.classList.add('active');
                }
                
                // Gestion de la suppression
                if (e.target.classList.contains('delete-task')) {
                    const taskId = e.target.getAttribute('data-id');
                    deleteForm.action = `/tasks/${taskId}`;
                    confirmModal.classList.add('active');
                }
            });
            
            // Fermer les modales
            function closeModals() {
                modal.classList.remove('active');
                confirmModal.classList.remove('active');
            }
            
            closeModalButton.addEventListener('click', closeModals);
            cancelButton.addEventListener('click', closeModals);
            closeConfirmModalButton.addEventListener('click', closeModals);
            cancelDeleteButton.addEventListener('click', closeModals);
            
            // Gestion du glisser-déposer
            let draggedTask = null;
            
            document.querySelectorAll('.task').forEach(task => {
                task.addEventListener('dragstart', function() {
                    draggedTask = this;
                    setTimeout(() => {
                        this.classList.add('dragging');
                    }, 0);
                });
                
                task.addEventListener('dragend', function() {
                    this.classList.remove('dragging');
                    document.querySelectorAll('.column').forEach(col => {
                        col.classList.remove('highlight');
                    });
                    
                    // Mettre à jour le statut de la tâche via le backend
                    if (draggedTask) {
                        const newStatus = this.parentElement.parentElement.getAttribute('data-status');
                        const taskId = this.getAttribute('data-id');
                        
                        fetch(`/tasks/${taskId}`, {
                            method: 'PUT',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                status: newStatus,
                                _method: 'PUT'
                            })
                        }).then(response => {
                            if (!response.ok) {
                                throw new Error('Erreur lors de la mise à jour');
                            }
                            return response.json();
                        }).catch(error => {
                            console.error('Erreur:', error);
                        });
                    }
                });
            });
            
            document.querySelectorAll('.column').forEach(column => {
                column.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    this.classList.add('highlight');
                    
                    const afterElement = getDragAfterElement(this.querySelector('.tasks'), e.clientY);
                    const tasksContainer = this.querySelector('.tasks');
                    
                    if (afterElement == null) {
                        tasksContainer.appendChild(draggedTask);
                    } else {
                        tasksContainer.insertBefore(draggedTask, afterElement);
                    }
                });
                
                column.addEventListener('dragleave', function() {
                    this.classList.remove('highlight');
                });
                
                column.addEventListener('drop', function(e) {
                    e.preventDefault();
                    this.classList.remove('highlight');
                });
            });
            
            function getDragAfterElement(container, y) {
                const draggableElements = [...container.querySelectorAll('.task:not(.dragging)')];
                
                return draggableElements.reduce((closest, child) => {
                    const box = child.getBoundingClientRect();
                    const offset = y - box.top - box.height / 2;
                    
                    if (offset < 0 && offset > closest.offset) {
                        return { offset: offset, element: child };
                    } else {
                        return closest;
                    }
                }, { offset: Number.NEGATIVE_INFINITY }).element;
            }
        });
    </script>
</body>
</html>