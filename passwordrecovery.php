<!--password recovery panel-->
<div class="tab-pane" id="password1" role="tabpanel">
    <div class="card-body">
        <form class="row" action="Reset_Password_Hr" method="post" enctype="multipart/form-data">
            <div class="form-group col-md-6 m-t-20">
                <label>Password</label>
                <input type="text" class="form-control" name="new1" value="" required="" minlength="6"> 
            </div>
            <div class="form-group col-md-6 m-t-20">
                <label>Confirm Password</label>
                <input type="text" id="" name="new2" class="form-control " required="" minlength="6"> 
            </div>
            <div class="form-actions col-md-12">
                <input type="hidden" name="emid" value="Soy1332">                                                   
                <button type="submit" class="btn btn-success pull-right"> <i class="fa fa-check"></i> Save</button>
            </div>
        </form>
    </div>
</div>
<div class="tab-pane" id="password" role="tabpanel">
    <div class="card-body">
        <form class="row" action="Reset_Password" method="post" enctype="multipart/form-data">
            <div class="form-group col-md-6 m-t-20">
                <label>Old Password</label>
                <input type="text" class="form-control" name="old" value="" placeholder="old password" required="" minlength="6"> 
            </div>
            <div class="form-group col-md-6 m-t-20">
                <label>Password</label>
                <input type="text" class="form-control" name="new1" value="" required="" minlength="6"> 
            </div>
            <div class="form-group col-md-6 m-t-20">
                <label>Confirm Password</label>
                <input type="text" id="" name="new2" class="form-control " required="" minlength="6"> 
            </div>
            <div class="form-actions col-md-12">
            <input type="hidden" name="emid" value="Soy1332">                                                   
                <button type="submit" class="btn btn-success pull-right"> <i class="fa fa-check"></i> Save</button>
            </div>
        </form>
    </div>
</div>