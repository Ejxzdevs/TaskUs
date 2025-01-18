<aside style="width: 230px; transition: width 0.3s ease; color: white;" id="sidebar">
    <header class="d-flex justify-between align-items-center pe-4 h-16 border-bottom d-flex flex-row  ps-4">
        <label class="path">
            TaskUs
        </label>
        <a class="cursor-pointer" id="toggle-btn">
            <i class="fas fa-bars"></i>
        </a>
    </header>
    <ul class="d-flex flex-col ">
        <li class="nav-item ps-4 h-10 flex items-center">
            <a style="font-size: 14px" class=" d-flex flex-row justify-center align-items-center gap-2" href="{{ route('home') }}">
                <i class="fas fa-home"></i>
                <span class="path">
                    Home
                </span>
            </a>
        </li>
        <li class="ps-4 h-10 flex items-center">
            <a style="font-size: 14px" class=" d-flex flex-row justify-center align-items-center gap-2" href="{{ route('tasks.index') }}">
                <i class="nav-item fas fa-list-check"></i>
                <span class="path">
                    Task
                </span>
            </a>
        </li>
    </ul>
</aside>

<script>
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('toggle-btn');
    const pathElements = document.querySelectorAll('.path');
    let isMinimized = false;

    function toggleSidebar() {
        isMinimized = !isMinimized;
        sidebar.style.width = isMinimized ? '80px' : '230px';
        pathElements.forEach(path => {
            path.style.display = isMinimized ? 'none' : 'inline';
        });
    }
    toggleBtn.addEventListener('click', toggleSidebar);
</script>
