<div class="box-header">
选择月份:
    <select id="" name="month">
        <?php foreach ($monthes as $month) { ?>
        <option value="<?php echo htmlspecialchars($month); ?>" 
            <?php if ($month == \Request::get('month')) { ?>
            selected="selected"
            <?php } ?>>
            <?php echo htmlspecialchars($month); ?>
        </option>
        <?php } ?>
    </select>
</div>
<?php echo ($table); ?>
<script>
$(function() {
    $('select').change(function() {
        var month = $("option:selected", this).text();
        window.location = "/admin/order/stats?month="+month;
    });
});
</script>
