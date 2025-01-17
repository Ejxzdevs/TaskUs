<aside style="width: 230px; transition: width 0.3s ease;" id="sidebar">
    <header class="h-16 border-bottom d-flex flex-row align-items-center ps-4">
        <label>
            LOGO
        </label>
        <a class="cursor-pointer" id="toggle-btn">
            ->
        </a>
    </header>
    <ul class="d-flex flex-col ">
        <li class="ps-4 h-10 flex items-center">
            <a style="font-size: 14px" class="d-flex flex-row gap-2" href="{{ route('home') }}">
                <i class="fas fa-home"></i>
                <span class="path">
                    About
                </span>
            </a>
        </li>
        <li class="ps-4 h-10 flex items-center">
            <a style="font-size: 14px" class="d-flex flex-row gap-2" href="{{ route('home') }}">
                <i class="fas fa-home"></i>
                <span class="path">
                    Contact
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
