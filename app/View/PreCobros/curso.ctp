    <select class="form-control select2" name="data[PreCobro][curso]" required id="curso" onchange="cuentas()">
        <?php foreach ($cursos as $cur): ?>
        <option value="<?php echo $cur[0]['id_curso']; ?>"><?php echo $cur[0]['nombre_curso']; ?></option>
        <?php endforeach; ?>
    </select>
<script>
    $(".select2").select2();
</script>