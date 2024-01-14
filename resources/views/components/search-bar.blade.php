
<form action="{{ route('profiles.search') }}" method="get" class="flex items-center">
    <input type="text" name="query" style="border-top: 1px dashed cornflowerblue;border-left: 1px dashed cornflowerblue;border-bottom: 1px dashed cornflowerblue;border-right: 0; background-color:white" class=" p-1" placeholder="Search user..." >
    <button title="search" type="submit" class="btn p-1" style="border-top: 1px dashed cornflowerblue;border-right: 1px dashed cornflowerblue;border-bottom: 1px dashed cornflowerblue;border-left: 0;color:cornflowerblue; background-color:aliceblue; --bs-btn-border-color: #9ca3af;"><i class="fa-solid fa-magnifying-glass"></i></button>
</form>
