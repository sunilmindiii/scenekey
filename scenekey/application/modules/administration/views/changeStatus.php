<script>
    function changeStatus(id, status, i, name)
    {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'admin/statusController/statusUpdate'; ?>",
            data: {id: id, status: status, name: name},
            cache: false,
            success: function (result)
            {
                if (status == 1)
                {
                    status = 0;
                    text = "<span class='label label-error'>Inactive</span>";
                }
                else if (status == 0)
                {
                    status = 1;
                    text = "<span class='label label-success'>Active</span>";
                }
                else
                {
                    status = 0;
                    text = "<span class='label label-error'>Inactive</span>";
                }

                $("#td" + i).html('<a href="javascript:void(0)" onclick="changeStatus(' + id + ',' + status + ',' + i + ',\'' + name + '\')">' + text + '</a>');
            }
        });
    }


    function dataDelete(str)
    {
        if (confirm("Are you sure to delete it?"))
        {
            window.location = "<?php echo base_url() . 'admin/statusController/dataDelete/'; ?>" + str;
        }
        else
        {
            return false;
        }
    }
</script>
