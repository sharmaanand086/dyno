<div class="content-wrapper">
	 
	<div class="row padtop">
			<div class="col-md-6 col-md-offset-3">
        <?php if($this->session->flashdata('class')): ?>  
      <div class="alert <?php echo $this->session->flashdata('class') ?>"  role="alert">
      <?php echo $this->session->flashdata('message'); ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
   <?php endif; ?>
        <h3>Add New client</h3>
  			<?php echo form_open_multipart('Login/addClient','','') ?>
  			 <label>Unique Id <span class="mendate">*</span></label>
  			   <lable id="errormsg" style="display:none;color:red">Invalid contactId<br></lable>
            <input type="text" placeholder="Enter your unique ID" name="contactid" id="contactid" class="unique-id form-control" >
            
            <div class="auto-generate" id="info">
                <label>Name <span class="mendate">*</span></label>
	            <input type="text" placeholder="Name" name="clientname" id="clientname" disabled=""   class="form-control">
	            <label>Email <span class="mendate">*</span></label>
	            <input type="email" placeholder="Email" name="clientemail" id="clientemail" disabled=""   class="form-control">
	            <label>phone <span class="mendate">*</span></label>
	            <input type="tel" placeholder="Number" name="clientphone" id="clientphone" disabled=""  class="form-control">
        	</div>
        	 <label>Date of Joining<span class="mendate">*</span> </label>
        	<input type="date" placeholder="Enter Joining Date" name="dofjoining" class="joining-date form-control">
        	<div class="auto-generate" id="details"  class="form-control">
        	    	 <label>City </label>
	            <input type="text" placeholder="City" disabled=""  name="city" class="form-control">
	            	 <label>Batch<span class="mendate">*</span></label>
	            <input type="text" placeholder="Batch Name" disabled=""  name="batchname" class="form-control">
        	</div>
        	 <label>Address  </label>
        	 <input type="text" placeholder="Address ..."  name="address" class="form-control">
        	 <label>Assigned Coach<span class="mendate">*</span></label>
	            <input type="text" placeholder="Coach Name" name="coach"  class="form-control">
	            	 <label>Assigned Co-coach <span class="mendate">*</span></label>
	            <input type="text" placeholder="Co-coach Name" name="co_coach" class="form-control">
	            <label>Program Name<span class="mendate">*</span></label>
        	<input type="text" placeholder="Program Name"  name="pgm_name" class="form-control">
        	
        	  <div class="col-md-12">
        	      <div class="row">
            	      <div class="col-md-6">
            	           <label> </label>
    	     	            <input type="number" placeholder="Program Price"  name="pgm_price"style="width:100%"  class="form-control"> 
            	      </div>
        	       <div class="col-md-6"> 
        	   <?php 
           $curroption = array();
           foreach ($currency->result() as $currencys) {  
             $curroption[$currencys->id] = $currencys->curr;
               } 
        ?>
        <?php echo form_dropdown('pgm_pr_crncy',$curroption,'','class="form-control"'); ?> 
        			</div>
			</div>
        </div>
          <div class="col-md-12">
        	   <div class="row">
            	   <div class="col-md-6">
            	          
            			 <label> </label>
                    	<input type="text" placeholder="Amount paid at venue" name="paid_at_vanue" style="width:100%"  class="form-control">
                    </div>
                    	 <div class="col-md-6"> 
                    	  <?php 
           $curroption = array();
           foreach ($currency->result() as $currencys) {  
             $curroption[$currencys->id] = $currencys->curr;
               } 
        ?>
        <?php echo form_dropdown('vanue_pr_crncy',$curroption,'','class="form-control"'); ?> 
                    </div>

            </div>
        </div>
         <label>Mode Of Payment  </label>
        	 <input type="text" placeholder="Mode of Payment..."  name="modofpayment" class="form-control">
  				<div class="form-group">
            <label> Signup-form<span class="mendate">*</span></label>
  					<?php echo form_upload('signupformimg','class="form-control"',''); ?>
  				</div>
  				<div class="form-group">
  					<?php echo form_submit('Add client','Add Newclient','class="btn btn-primary"'); ?>
  				</div>

  			<?php echo form_close(); ?>
			</div>
	</div>
</div>
