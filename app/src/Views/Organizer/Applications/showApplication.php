<div class="container">
    <div class="row justify-content-around">
        <div class="col-10">
            <h2 class="my-3"><?= $application->title ?></h1>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($application->submittedApplications() as $submittedApp) { ?>
                    <tr>
                        <th scope="row"><a class="" href="<?=ROOT?>/organizer/applications/submitted/<?= $submittedApp->id ?>"><?= $submittedApp->id ?></a></th>
                        <td><?= $submittedApp->business_name ?></td>
                        <td><?= $submittedApp->business_email ?></td>
                        <td><?= $submittedApp->business_phone ?></td>
                        <td>
                            <?php $statusClass = match($submittedApp->status) {
                                        'waitlist' => 'text-secondary',
                                        'approved' => 'text-success',
                                        'denied' => 'text-danger'
                                    };
                            ?>
                            <div class="btn-group">
                                <button class="btn btn-sm dropdown-toggle fw-bolder" type="button" data-bs-toggle="dropdown" aria-expanded="false" >
                                    <span class="<?= $statusClass ?>" style="text-transform:capitalize;"><?= $submittedApp->status ?></span>
                                </button>
                                <ul data-application-id="<?= $submittedApp->id ?>" class="statusDropdown dropdown-menu">
                                    <li><button class="dropdown-item text-secondary" type="button" value="waitlist">Waitlist</button></li>
                                    <li><button class="dropdown-item text-success" type="button" value="approved">Approve</button></li>
                                    <li><button class="dropdown-item text-danger" type="button" value="denied" >Deny</button></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <? }?>   
                </tbody> 
            </table>
        </div>
    </div>
</div>
<script src="<?=ROOT?>/public/JS/jquery-3.7.1.min.js"></script>
<script>
$('.statusDropdown button').click(function(){
        let newStatus = $(this).val();
        let ulDropdown = $(this).parents("ul.statusDropdown")
        let applicationId = ulDropdown.data("applicationId");
        let url = "<?=ROOT . "/organizer/applications/submitted/"?>" + applicationId + "/status"
        $.ajax({
            type: "PATCH",
            url: url,
            data: {status: newStatus},
            dataType: "text json",
            success: function(data){
                let jsAlert = $(".js-alert-toast");
                if(data['type'] == "error") {
                    $(".js-alert-toast-header").text("Error")
                    jsAlert.addClass("bg-danger")
                }
                if(data['type'] == "success") {
                    $(".js-alert-toast-header").text("Success")
                    jsAlert.addClass("bg-success")   
                    let spanDropdown = ulDropdown.siblings("button.dropdown-toggle").children();
                    spanDropdown.removeClass();
                    if (newStatus == "denied") {
                        spanDropdown.addClass("text-danger");
                    } else if (newStatus == "approved") {
                        spanDropdown.addClass("text-success");
                    } else {
                        spanDropdown.addClass("text-secondary");
                    }
                    spanDropdown.text(newStatus)
                }
                $(".js-alert-toast-body").text(data['message'])
                let bsFlashAlert = new bootstrap.Toast(jsAlert);
                bsFlashAlert.show();
            },
        });
});    
</script>