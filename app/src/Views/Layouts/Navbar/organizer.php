<li class="nav-item dropdown mr-3">
    <a class="nav-link dropdown-toggle <?php if(isset($viewPage) && $viewPage == 'applications') echo "active" ?>" 
        data-bs-toggle="dropdown" aria-expanded="false">Applications 
    </a>
    <ul class="dropdown-menu">            
        <li><a class="dropdown-item" href="<?=ROOT?>/organizer/applications">View</a></li>
        <li><a class="dropdown-item" href="<?=ROOT?>/organizer/applications/create">Create</a></li>
    </ul>
</li>
<li class="nav-item">
    <a class="nav-link" href="#">Another Link</a>
</li>