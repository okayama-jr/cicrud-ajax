        <h2>BLOG LIST</h2>
        <?php
            if($this->session->flashdata('success_msg')){
        ?>
            <div class="alert alert-success">
                <?=$this->session->flashdata('success_msg');?>
            </div>
        <?php   
            }
        ?>
        <?php
            if($this->session->flashdata('error_msg')){
        ?>
            <div class="alert alert-danger">
                <?=$this->session->flashdata('error_msg');?>
            </div>
        <?php   
            }
        ?>

        <a href="<?=base_url('blog/add');?>" class="btn btn-primary">Add list</a>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if($result){
                    foreach($result as $blog){
            ?>
                <tr>
                    <td><?=$blog->id;?></td>
                    <td><?=$blog->title;?></td>
                    <td><?=$blog->description;?></td>
                    <td><?=$blog->created_at;?></td>
                    <td>
                        <a href="<?=base_url('blog/edit/'.$blog->id);?>" class="btn btn-info">Edit</a>
                        <a href="<?=base_url('blog/delete/'.$blog->id);?>" class="btn btn-danger" onClick="return confirm('Do you want to delete this record?')">Delete</a>
                    </td>
                </tr>
            <?php
                    }
                }
            ?>
            </tbody>
        </table>