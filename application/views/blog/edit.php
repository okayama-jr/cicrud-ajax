<h2>EDIT LIST</h2>
        <a href="<?=base_url('blog/index');?>" class="btn btn-default">BACK</a>
        <form action="<?=base_url('blog/update');?>" method="post" class="form-horizontal">
            <input type="hidden" name="txt_id" value="<?=$result->id;?>">
            <div class="form-group">
                <label for="title" class="col-md-2 text-right">Title</label>
                <div class="col-md-10">
                    <input type="text" value="<?=$result->title;?>" name="txt_title" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="col-md-2 text-right">Description</label>
                <div class="col-md-10">
                    <textarea name="txt_description" class="form-control"><?=$result->description;?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 text-right"></label>
                <div class="col-md-10">
                    <input type="submit" name="btnSave" class="btn btn-primary" value="Update">
                </div>
            </div>
        </form>