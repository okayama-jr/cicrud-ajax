<h2>ADD LIST</h2>
        <a href="<?=base_url('blog/index');?>" class="btn btn-default">BACK</a>
        <form action="<?=base_url('blog/submit');?>" method="post" class="form-horizontal">
            <div class="form-group">
                <label for="title" class="col-md-2 text-right">Title</label>
                <div class="col-md-10">
                    <input type="text" name="txt_title" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="col-md-2 text-right">Description</label>
                <div class="col-md-10">
                    <textarea name="txt_description" class="form-control"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 text-right"></label>
                <div class="col-md-10">
                    <input type="submit" name="btnSave" class="btn btn-primary" value="Save">
                </div>
            </div>
        </form>