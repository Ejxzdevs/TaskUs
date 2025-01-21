<aside style="width: 230px; transition: width 0.3s ease; color: white;" id="sidebar">
    <header class="d-flex justify-between align-items-center pe-4 h-16 border-bottom d-flex flex-row  ps-4">
        <label class="path text-white " style="font-family: 'Rubik Vinyl'; font-size: 22px; ">
            TaskUs
        </label>
        <a class="cursor-pointer" id="toggle-btn">
            <i class="fas fa-bars"></i> 
        </a>
    </header>
    <ul class="d-flex flex-col gap-2 pt-3 ">
        <li class="nav-item ps-4 h-10 flex items-center">
            <a style="font-size: 14px" class=" d-flex flex-row justify-center align-items-center gap-2" href="{{ route('home') }}">
                <i class="fas fa-home"></i>
                <span class="path">
                    Dashboard
                </span>
            </a>
        </li>
        <li class="ps-4 h-10 flex items-center">
            <a style="font-size: 14px" class=" d-flex flex-row justify-center align-items-center gap-2" href="{{ route('tasks.index') }}">
                <i class="nav-item fas fa-list-check"></i>
                <span class="path">
                    To Do List
                </span>
            </a>
        </li>
        <li class="ps-4 h-10 flex items-center">
            <a style="font-size: 14px" class=" d-flex flex-row justify-center align-items-center gap-2" href="{{ route('review') }}">
                <i class="fa fa-comments"></i>
                <span class="path">
                    Review
                </span>
            </a>
        </li>
        <li class="ps-4 h-10 flex items-center">
            <a style="font-size: 14px" class=" d-flex flex-row justify-center align-items-center gap-2" href="{{ route('history') }}">
                <i class="fa fa-history"></i>
                <span class="path">
                    History
                </span>
            </a>
        </li>
        <li class="ps-4 h-10 flex items-center">
            <a style="font-size: 14px" class=" d-flex flex-row justify-center align-items-center gap-2" href="{{ route('member') }}">
                <i class="fa fa-user"></i>
                <span class="path">
                    Member
                </span>
            </a>
        </li>
        <li class="ps-4 h-10 flex items-center">
            <a style="font-size: 14px" class=" d-flex flex-row justify-center align-items-center gap-2" href="{{ route('logout') }}">
                <i class="fas fa-sign-out-alt"></i>
                <span class="path">
                    Logout
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
