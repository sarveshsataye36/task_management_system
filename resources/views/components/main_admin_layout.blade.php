<x-layout>
    <x-slot name="title">Dashboard</x-slot>
        <header class="header" id="header">
            <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
            <div class="Title"> {{auth()->user()->role}} </div>
        </header>
        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div> <a href="{{route('dashboard')}}" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span
                            class="nav_logo-name">Task Management</span> </a>
                    <div class="nav_list"> 
                            <a href="{{route('dashboard')}}" class="nav_link active"> 
                            <i class='bx bx-grid-alt nav_icon'></i> 
                            <span class="nav_name">Dashboard</span> </a> 

                            @if (auth()->user()->role == 'superAdmin' || auth()->user()->role == 'teamLeader' )
                                <a href="{{route('user.index')}}" class="nav_link">
                                    <i class='bx bx-user nav_icon'></i>
                                    <span class="nav_name">User</span>
                                </a>
                            @endif

                            @if (auth()->user()->role == 'superAdmin')
                                <a href="{{route('project.index')}}" class="nav_link"> 
                                    <i class='bx bx-news nav_icon'></i> 
                                    <span class="nav_name">Project</span>
                                </a>
                            @endif
                            
                            <a href="{{route('task.index')}}" class="nav_link"> 
                                <i class='bx bx-task nav_icon'></i> 
                                <span class="nav_name">Task</span>
                            </a>
                        </div>
                    </div>
                 <a href="{{route('logout')}}" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> 
                    <span class="nav_name">SignOut</span> </a>
            </nav>
        </div>
        <!--Container Main start-->
        <div>
            {{$slot}}
        </div>
        <!--Container Main end-->
</x-layout>
