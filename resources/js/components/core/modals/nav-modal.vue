<template> <div>

<div class="modal fade" id="guest-nav" tabindex="-1" role="dialog" aria-labelledby="guest-nav" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >
         <slot name="menu-title"></slot>
        </h5>
        <button type="button" class="btn btn-outline" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <slot name="menu-body"></slot>
      </div>
      <div class="modal-footer">
       <slot name="menu-footer"></slot>
     
        
      </div>
    </div>
  </div>
</div>
 
 
</div>
</template>