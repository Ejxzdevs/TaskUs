@php
   $userStatus = Session::get('user_role');
@endphp

<nav class="border-bottom  text-white d-flex flex-row justify-between items-center px-3 h-100 gap-1" style="background-color: #963061" >
   <div>
      <p>Todo List</p>
      <p id="time" style='font-family: "Audiowide", serif;'></p>
   </div>
   <div class="d-flex flex-row gap-2 justify-center items-center" >
      <i class="fas fa-user-circle fs-2"></i>
      <p style="font-size: 14px">{{$userStatus}}</p>
   </div>
</nav>
<script>
   function updateTime() {
    const timeElement = document.getElementById('time');
    const now = new Date();

    let hours = now.getHours();
    let minutes = now.getMinutes();
    let seconds = now.getSeconds();

    // Determine AM or PM
    const amPm = hours >= 12 ? 'PM' : 'AM';

    // Convert hour from 24-hour format to 12-hour format
    hours = hours % 12;
    hours = hours ? hours : 12; // 0 becomes 12 for midnight

    // Format time to always show two digits
    minutes = minutes < 10 ? '0' + minutes : minutes;
    seconds = seconds < 10 ? '0' + seconds : seconds;

    timeElement.textContent = `${hours}:${minutes}:${seconds} ${amPm}`;
}

   setInterval(updateTime, 1000);
   updateTime();
</script>