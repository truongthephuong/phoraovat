
<script type='text/javascript' src="/js/user.js"></script>
<script type='text/javascript' src="/js/assets/common.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>bootstrap/css/bootstrap-toggle.min.css" />
<script type='text/javascript' src="<?=base_url()?>bootstrap/js/bootstrap-toggle.min.js"></script>
<!--<script type='text/javascript' src="<?/*=base_url()*/?>bootstrap/js/bootstrap.js"></script>-->
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/user.css" />


<div class="container-fluid contentbox">
    <!--<div class="current-page">Settings </div>-->
    <!--Load menu tab-->
    <?php $this->load->view('/admin/product_tab')?>
    <div class="panel panel-default">
        <div class="panel-body">
            <!-- Tabs -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="cate">
                    <div class="row">
                        <div class="col-sm-11 pd-right">
                            <div class="table-header">
                                <div class="table-header-text">Quản Lý Danh Mục Con 1</div>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <a href="<?php echo base_url('admin/products').'/addSubCate1'?>" class="btn btn-primary addnew">
                                <span class=" glyphicon  glyphicon glyphicon-plus" aria-hidden="true"></span> Thêm mới
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Name</th>
                                    <th>Icon</th>
                                    <th>Rank</th>
                                    <th>Enable</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if (!empty($lstProd)) :
                                    foreach($lstProd as $prod):
                                ?>
                                    <tr>
                                        <td><?=$prod->id?></td>
                                        <td><?=$prod->catename?></td>
                                        <td><?=$prod->subcatename?></td>
                                        <td><?=$prod->name?></td>
                                        <td>
                                            <img src="<?php echo ($prod->icon) ? '/upload/icons/'.$prod->icon : '/images/logo.gif'?>" style="width: 40px">
                                        </td>
                                        <td>
                                            <span id="elRank<?=$prod->id?>" style="width: 100px;">
                                                <a href="#" id="<?=$prod->id?>" onclick="comObj.changeRank(<?=$prod->id?>,<?=$prod->rank?>,'sub2categories')" title="change order of news category">
                                                    <?=$prod->rank?>
                                                </a>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="#" onClick ="javascript:comObj.changeStatus('/admin/products/changeStatus/<?=$prod->id?>/<?=$prod->status?>/subCate2');">
                                                <input type="checkbox" <?=$prod->status == '1' ? 'checked' : '' ?> data-toggle="toggle" data-on="ENABLED" data-off="DISABLED" data-onstyle="success" data-offstyle="danger" data-size="mini" data-width="120px">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="subCateEdit1/<?=$prod->id?>/<?=$curPage?>" role="button" class="btn" >
                                                <i class="edit-icon fa fa-pencil-square-o"></i>
                                            </a>
                                            <i class="trash-icon fa fa-trash" data-toggle="modal" data-target="#delete"></i>
                                        </td>
                                    </tr>
                                <?php
                                    endforeach;
                                    else :
                                        echo '<tr><td colspan="8">Data empty</td></tr>';
                                    endif;
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" id="pagination">
                <ul class="pagination tsc_pagination" style="float:left">
                    <?php
                    foreach ($paginations as $pagination) {
                        echo "<li>". $pagination."</li>";
                    }
                    ?>
                </ul>
            </div>
        </div>

    </div>

</div>

