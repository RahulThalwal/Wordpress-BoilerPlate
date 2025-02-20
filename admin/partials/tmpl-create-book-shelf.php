<div class="row" style="margin-top:20px; margin-right: 23px; margin-left: 13px;">
    <div class="col-sm-5"></div>
    <div class="panel panel-primary">
        <div class="panel-heading">Create Book Shelf
            <button class="btn btn-warning pull-right"  id="btn-first-ajax" style="margin-top: -7px;">First Ajax Request</button>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" action="javascript:void(0)" id="frm-add-book-shelf">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="txt_name">Name:</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="txt_name" id="txt_name"
                            placeholder="Enter Book Shelf Name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="txt_capacity">Capacity</label>
                    <div class="col-sm-5">
                        <input type="number" min="1" class="form-control" name="txt_capacity" id="txt_capacity"
                            placeholder="Enter Capacity">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="txt_location">Shelf Location:</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="txt_location" id="txt_location"
                            placeholder="Enter Location">
                    </div>
                </div>





                <div class="form-group">
                    <label class="control-label col-sm-2" for="dd_status">Status</label>
                    <div class="col-sm-5">
                        <select class="form-control" name="dd_status">
                            <option value="active"> Active </option>
                            <option value="Inctive"> Inactive </option>

                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-5">
                        <div class="checkbox">
                            <label><input type="checkbox"> Remember me</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-5">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>