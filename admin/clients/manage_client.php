<?php
require_once('../../config.php');
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `client_list` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}
?>
<style>
    #cimg{
        object-fit:scale-down;
        object-position:center center;
        height:200px;
        width:200px;
    }
</style>
<div class="container-fluid">
    <form action="" id="client-form">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div class="row">
            <div class="form-group col-md-6">
                <label for="firstname" class="control-label">First Name</label>
                <input type="text" name="firstname" id="firstname" class="form-control form-control-border" placeholder="First Name" value ="<?php echo isset($firstname) ? $firstname : '' ?>" required>
            </div>
            <div class="form-group col-md-6">
                <label for="middlename" class="control-label">Middle Name <em>(optional)</em></label>
                <input type="text" name="middlename" id="middlename" class="form-control form-control-border" placeholder="Middle Name (optional)" value ="<?php echo isset($middlename) ? $middlename : '' ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="lastname" class="control-label">Last Name</label>
                <input type="text" name="lastname" id="lastname" class="form-control form-control-border" placeholder="Last Name" value ="<?php echo isset($lastname) ? $lastname : '' ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="email" class="control-label">Email</label>
                <input type="text" name="email" id="email" class="form-control form-control-border" placeholder="Email" value ="<?php echo isset($email) ? $email : '' ?>" required>
            </div>
            <div class="form-group col-md-6">
                <label for="contact" class="control-label">Contact #</label>
                <input type="text" name="contact" id="contact" class="form-control form-control-border" placeholder="Contact #" value ="<?php echo isset($contact) ? $contact : '' ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label for="address" class="control-label">Address</label>
                <textarea rows="3" name="address" id="address" class="form-control form-control-sm rounded-0" placeholder="Block 6, Lot 23, Here Subd., There City, 2306" required><?php echo isset($address) ? $address : '' ?></textarea>
            </div>
        </div>
    </form>
</div>
<script>
    $(function(){
        $('#uni_modal #client-form').submit(function(e){
            e.preventDefault();
            var _this = $(this)
            $('.pop-msg').remove()
            var el = $('<div>')
                el.addClass("pop-msg alert")
                el.hide()
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_client",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
                success:function(resp){
                    if(resp.status == 'success'){
                        location.reload();
                    }else if(!!resp.msg){
                        el.addClass("alert-danger")
                        el.text(resp.msg)
                        _this.prepend(el)
                    }else{
                        el.addClass("alert-danger")
                        el.text("An error occurred due to unknown reason.")
                        _this.prepend(el)
                    }
                    el.show('slow')
                    $('html,body,.modal').animate({scrollTop:0},'fast')
                    end_loader();
                }
            })
        })
    })
</script>