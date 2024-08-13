<div class="toast-container top-0 end-0 p-3">
    <div role="alert" aria-live="polite" aria-atomic="true" class="js-alert-toast toast" data-bs-delay="10000" style="margin: 0.5rem">
        <div class="toast-header" style="background-color: rgba(255,255,255,0.7)">
            <strong class="me-auto js-alert-toast-header"> </strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body js-alert-toast-body" style="background-color: rgba(255,255,255,0.9)">
            
        </div>
    </div>
    <?php foreach($flashMessages as $key=>$flash ) { ?>
        <div role="alert" aria-live="polite" aria-atomic="true" class="flash-alert-toast toast bg-<?=$flash['type']?>" data-bs-delay="10000" style="margin: 0.5rem">
            <div class="toast-header" style="background-color: rgba(255,255,255,0.7)">
                <strong class="me-auto"><?=$key?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" style="background-color: rgba(255,255,255,0.9)">
                <?=$flash['message']?>
            </div>
        </div>
    <?php }?>
  </div>
  <script>
    window.onload = (event) => {
        const flashAlerts = document.querySelectorAll('.flash-alert-toast');
        flashAlerts.forEach((flashAlert) => {
            let bsFlashAlert = new bootstrap.Toast(flashAlert);
            bsFlashAlert.show();
        })
    }
  </script>
