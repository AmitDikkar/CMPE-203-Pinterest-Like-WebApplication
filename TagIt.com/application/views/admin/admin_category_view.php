<?php $this->load->view('admin/admin_header');?>
<div id="Main_Wrapper" class="clearfix">
<?php $this->load->view('admin/admin_sidebar');?>
    <div id="Content_Wrapper">
    	<div class="Box">
        	<div class="Box_Head"></div>
                <div class="Box_Content">
                    <div id="Shorts_key" class="sub_box">
                        <h2>CATEGORY MANAGEMENT</h2>

                        <div id="pin_pagination">
                        <?php echo $this->pagination->create_links(); ?>
                        </div>
                        <?php ?>
                        <?php if(!empty ($category)):?>
                            <table>
                                <thead>
                                    <th>Id</th>
                                    <th>Field</th>
                                    <th>Name</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </thead>
                                <tbody>
                                    <?php foreach ($category as $key => $value):?>
                                        <tr id="tr_<?php echo $value->id;?>">

                                            <td><?php echo $value->id;?></td>

                                            <td><?php echo $value->field;?></td>

                                            <td><?php echo $value->name;?></td>
   
                                            <td id="edit_<?php echo $value->id;?>"><a href="<?php echo site_url('administrator/editCategory/'.$value->id);?>" rel="facebox"><img src="<?php echo site_url('application/ui/images/admin/edit.png');?>"/></a></td>
                                            <td id="remove_<?php echo $value->id;?>"><a href="<?php echo site_url('administrator/confirmDeleteCategory/'.$value->id);?>" rel="facebox"><img src="<?php echo site_url('application/ui/images/admin/delete.png');?>"/></a></td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>

                            </table>
                        <?php endif?>
                        <span id="message"></span>
                        <div id="bar_chat_wrapper" class="k-content">
                            <div class="chart-wrapper">
                                <div id="chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>