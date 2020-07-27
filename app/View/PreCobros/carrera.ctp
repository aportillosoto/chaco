
    <select class="form-control select2" name="data[PreCobro][carrera]" required id="carrera" onchange="cursos()">
        <?php foreach ($carreras as $car): ?>
        <option value="<?php echo $car[0]['id_carre']; ?>"><?php echo $car[0]['nombre_carre']; ?></option>
        <?php endforeach; ?>
    </select>
<script>
    $(".select2").select2();
</script>