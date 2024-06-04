document.addEventListener('DOMContentLoaded', () => {
    fetchData();
    fetchOptions();

    document.getElementById('create-task-form').addEventListener('submit', createTask);
    document.getElementById('filter-btn').addEventListener('click', applyFilters);
});

async function fetchData() {
    const response = await fetch('http://localhost:8000/api/tasks');
    const tasks = await response.json();
    renderTasks(tasks);
}

async function fetchOptions() {
    const [employees, states, priorities] = await Promise.all([
        fetch('http://localhost:8000/api/employees').then(res => res.json()),
        fetch('http://localhost:8000/api/states').then(res => res.json()),
        fetch('http://localhost:8000/api/priorities').then(res => res.json())
    ]);

    populateSelect('idEmpleado', employees);
    populateSelect('idEstado', states);
    populateSelect('idPrioridad', priorities);
    populateSelect('filter-priority', priorities);
}

function populateSelect(selectId, options) {
    const select = document.getElementById(selectId);
    options.forEach(option => {
        const opt = document.createElement('option');
        opt.value = option.id;
        opt.text = option.nombre;
        select.add(opt);
    });
}

function renderTasks(tasks) {
    const tbody = document.querySelector('#tasks-table tbody');
    tbody.innerHTML = '';
    tasks.forEach(task => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${task.titulo}</td>
            <td>${task.descripcion}</td>
            <td>${task.fechaEstimadaFinalizacion}</td>
            <td>${task.creadorTarea}</td>
            <td>${task.employee.nombre}</td>
            <td>${task.state.nombre}</td>
            <td>${task.priority.nombre}</td>
            <td>
                <button onclick="deleteTask(${task.id})">Delete</button>
                <button onclick="changeState(${task.id})">Change State</button>
            </td>
        `;
        tbody.appendChild(row);
    });
}

async function createTask(event) {
    event.preventDefault();
    const formData = new FormData(event.target);
    const data = Object.fromEntries(formData.entries());
    
    const response = await fetch('http://localhost:8000/api/tasks', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });
    
    if (response.ok) {
        fetchData();
        event.target.reset();
    } else {
        console.error('Error creating task');
    }
}

async function deleteTask(taskId) {
    const response = await fetch(`http://localhost:8000/api/tasks/${taskId}`, {
        method: 'DELETE'
    });

    if (response.ok) {
        fetchData();
    } else {
        console.error('Error deleting task');
    }
}

async function changeState(taskId) {
    // Add logic to change the state of the task
    // e.g., open a modal to select the new state
}

async function applyFilters() {
    const priority = document.getElementById('filter-priority').value;
    const startDate = document.getElementById('filter-date-start').value;
    const endDate = document.getElementById('filter-date-end').value;

    const query = new URLSearchParams();
    if (priority) query.append('idPrioridad', priority);
    if (startDate) query.append('fecha_inicio', startDate);
    if (endDate) query.append('fecha_fin', endDate);

    const response = await fetch(`http://localhost:8000/api/tasks/filter?${query.toString()}`);
    const tasks = await response.json();
    renderTasks(tasks);
}
