<tr>
    <td><a target="_blank" href="<?php echo R('common', 'blog.content.index', ['classify' => $value['id']]); ?>"><span style="color:#ccc;"><?php echo $prefix; ?></span><?php echo $value['name']; ?></a></td>
    <td>
        <?php echo $value['is_active'] == 1 ? '<i class="fa fa-check" style="color:green;"></i>' : '<i class="fa fa-times" style="color:red;"></i>'; ?>
    </td>
    <td><?php echo isset($value['articleNums']) ? $value['articleNums'] : 0; ?></td>
    <td><?php echo date('Y-m-d H:i', $value['time']); ?></td>
    <td>
        <?php echo widget('Admin.Dept')->edit($value); ?>
        <?php echo widget('Admin.Dept')->delete($value); ?>
    </td>
</tr>